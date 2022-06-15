<?php declare(strict_types=1);

namespace pcrov\Unicode;

/**
 * Translates a UTF-16 surrogate pair into a single code point.
 *
 * Example: \uD852\uDF62 == \u{24B62} == 𤭢
 *
 * @see https://en.wikipedia.org/wiki/UTF-16#U.2B10000_to_U.2B10FFFF
 *
 * @throws \OutOfRangeException If either surrogate is out of their respective range.
 */
function surrogate_pair_to_code_point(int $high, int $low): int
{
    if ($high < 0xd800 || 0xdbff < $high) {
        throw new \OutOfRangeException("High surrogate not within range 0xD800..0xDBFF.");
    }

    if ($low < 0xdc00 || 0xdfff < $low) {
        throw new \OutOfRangeException("Low surrogate not within range 0xDC00..0xDFFF.");
    }

    return 0x10000 + (($high & 0x03ff) << 10) + ($low & 0x03ff);
}

/**
 * @return int|null The position of the first invalid byte sequence or null if the input is valid.
 */
function utf8_find_invalid_byte_sequence(string $string)
{
    // Faster expressions are possible but this is safe from backtracking
    // limits and such on very long strings.
    static $regex = <<<'REGEX'
            /
            (?(DEFINE)
                (?<valid>
                    [\x00-\x7F]                            |  # U+0000..U+007F
                    [\xC2-\xDF] [\x80-\xBF]                |  # U+0080..U+07FF
                    \xE0        [\xA0-\xBF] [\x80-\xBF]    |  # U+0800..U+0FFF
                    [\xE1-\xEC] [\x80-\xBF]{2}             |  # U+1000..U+CFFF
                    \xED        [\x80-\x9F] [\x80-\xBF]    |  # U+D000..U+D7FF
                    [\xEE-\xEF] [\x80-\xBF]{2}             |  # U+E000..U+FFFF
                    \xF0        [\x90-\xBF] [\x80-\xBF]{2} |  # U+10000..U+3FFFF
                    [\xF1-\xF3] [\x80-\xBF]{3}             |  # U+40000..U+FFFFF
                    \xF4        [\x80-\x8F] [\x80-\xBF]{2} |  # U+100000..U+10FFFF
                    \Z
                )
            )
            \A(?!(?&valid)) |
            (?&valid)(?!(?&valid))
            /x
REGEX;

    if (!\preg_match($regex, $string, $matches, \PREG_OFFSET_CAPTURE)) {
        return null;
    }

    return \strlen($matches[0][0]) + $matches[0][1];
}

/**
 * @return string|null The first invalid byte sequence or null if the input is valid.
 */
function utf8_get_invalid_byte_sequence(string $string)
{
    if (utf8_validate($string)) {
        return null;
    }

    $position = utf8_find_invalid_byte_sequence($string);
    $sequence = $string[$position];

    $ord = \ord($sequence);
    if (!(($ord >> 5) ^ 0b110)) {
        $expect = 1;
    } elseif (!(($ord >> 4) ^ 0b1110)) {
        $expect = 2;
    } elseif (!(($ord >> 3) ^ 0b11110)) {
        $expect = 3;
    } else {
        return $sequence;
    }

    $continuationBytes = (string)\substr($string, $position + 1, $expect);

    for (
        $i = 0, $continuationBytesLength = \strlen($continuationBytes);
        $i < $continuationBytesLength;
        $i++
    ) {
        $byte = $continuationBytes[$i];

        if ((\ord($byte) >> 6) ^ 0b10) {
            break;
        }

        $sequence .= $byte;
    }

    return $sequence;
}

/**
 * @return array State machine of valid UTF-8 bytes in the form of:
 *     [byte => [valid next byte => ...,], ...]
 */
function utf8_get_state_machine(): array
{
    static $machine = null;

    if ($machine !== null) {
        return $machine;
    }

    $start = [];
    $u40000_uFFFFF_2nd_byte = [];
    $penultimate = [];
    $last = [];

    // Common final bytes
    foreach (\range("\x80", "\xBF") as $byte) {
        $last[$byte] = &$start;
    }

    // Common second to last bytes
    foreach (\range("\x80", "\xBF") as $byte) {
        $penultimate[$byte] = &$last;
    }

    // U+0000..U+007F
    foreach (\range("\x0", "\x7F") as $byte) {
        $start[$byte] = &$start;
    }

    // U+0080..U+07FF
    foreach (\range("\xC2", "\xDF") as $byte) {
        $start[$byte] = &$last;
    }

    // U+0800..U+0FFF
    foreach (\range("\xA0", "\xBF") as $byte) {
        $start["\xE0"][$byte] = &$last;
    }

    // U+1000..U+CFFF
    foreach (\range("\xE1", "\xEC") as $byte) {
        $start[$byte] = &$penultimate;
    }

    // U+D000..U+D7FF
    foreach (\range("\x80", "\x9F") as $byte) {
        $start["\xED"][$byte] = &$last;
    }

    // U+E000..U+FFFF
    foreach (\range("\xEE", "\xEF") as $byte) {
        $start[$byte] = &$penultimate;
    }

    // U+10000..U+3FFFF
    foreach (\range("\x90", "\xBF") as $byte) {
        $start["\xF0"][$byte] = &$penultimate;
    }

    // U+40000..U+FFFFF
    foreach (\range("\xF1", "\xF3") as $byte) {
        $start[$byte] = &$u40000_uFFFFF_2nd_byte;
    }

    // U+40000..U+FFFFF Second byte
    foreach (\range("\x80", "\xBF") as $byte) {
        $u40000_uFFFFF_2nd_byte[$byte] = &$penultimate;
    }

    // U+100000..U+10FFFF
    foreach (\range("\x80", "\x8F") as $byte) {
        $start["\xF4"][$byte] = &$penultimate;
    }

    $machine = $start;

    return $machine;
}

function utf8_validate(string $string): bool
{
    return (bool)\preg_match("//u", $string);
}
