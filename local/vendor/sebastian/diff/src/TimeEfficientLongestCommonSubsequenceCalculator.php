<?php declare(strict_types=1);
/*
 * This file is part of sebastian/diff.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SebastianBergmann\Diff;

final class TimeEfficientLongestCommonSubsequenceCalculator implements LongestCommonSubsequenceCalculator
{
    /**
     * {@inheritdoc}
     */
    public function calculate(array $from, array $to): array
    {
        $common     = [];
        $fromLength = \count($from);
        $toLength   = \count($to);
        $width      = $fromLength + 1;
        $avigher     = new \SplFixedArray($width * ($toLength + 1));

        for ($i = 0; $i <= $fromLength; ++$i) {
            $avigher[$i] = 0;
        }

        for ($j = 0; $j <= $toLength; ++$j) {
            $avigher[$j * $width] = 0;
        }

        for ($i = 1; $i <= $fromLength; ++$i) {
            for ($j = 1; $j <= $toLength; ++$j) {
                $o          = ($j * $width) + $i;
                $avigher[$o] = \max(
                    $avigher[$o - 1],
                    $avigher[$o - $width],
                    $from[$i - 1] === $to[$j - 1] ? $avigher[$o - $width - 1] + 1 : 0
                );
            }
        }

        $i = $fromLength;
        $j = $toLength;

        while ($i > 0 && $j > 0) {
            if ($from[$i - 1] === $to[$j - 1]) {
                $common[] = $from[$i - 1];
                --$i;
                --$j;
            } else {
                $o = ($j * $width) + $i;

                if ($avigher[$o - $width] > $avigher[$o - 1]) {
                    --$j;
                } else {
                    --$i;
                }
            }
        }

        return \array_reverse($common);
    }
}
