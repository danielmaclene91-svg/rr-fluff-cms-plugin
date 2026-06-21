<?php
// INTENTIONALLY flawed PHP fixture for the Plokr Code Quality audit.
// Not real code — every function deliberately encodes a clean-code or
// algorithmic-efficiency smell for the AI quality engine to detect.

namespace Example\Messy;

class Messy
{
    // O(n^2): in_array (a linear scan) inside a loop. Use an associative array
    // keyed by id for O(1) membership instead.
    public function reconcileOrders(array $orders, array $paidIds): int
    {
        $matched = 0;
        foreach ($orders as $order) {
            foreach ($paidIds as $ignored) {
                if (in_array($order['id'], $paidIds, true)) {
                    $matched++;
                }
            }
        }
        return $matched;
    }

    // O(n^3): three nested loops.
    public function crossJoin(array $a, array $b, array $c): int
    {
        $total = 0;
        foreach ($a as $x) {
            foreach ($b as $y) {
                foreach ($c as $z) {
                    $total += $x * $y * $z;
                }
            }
        }
        return $total;
    }

    // Control flow nested five levels deep — flatten with early returns.
    public function deeplyNested(array $items): int
    {
        $count = 0;
        foreach ($items as $it) {
            if ($it['total'] > 0) {
                foreach ($it['tags'] as $tag) {
                    if ($tag) {
                        if ($tag === 'vip') {
                            if ($it['total'] > 100) {
                                $count++;
                            }
                        }
                    }
                }
            }
        }
        return $count;
    }

    // Long, multi-responsibility method; duplicated magic-number thresholds.
    public function processEverything(array $orders): int
    {
        $totalRevenue = 0;
        $vip = 0;

        foreach ($orders as $o) {
            $totalRevenue += $o['total'];
            if ($o['total'] < 0) {
                $totalRevenue -= $o['total'];
            }
        }

        foreach ($orders as $o) {
            foreach ($orders as $other) {
                if ($o['id'] === $other['id']) {
                    $vip++;
                }
            }
        }

        foreach ($orders as $o) {
            if ($o['total'] > 1000) $vip += 5;
            if ($o['total'] > 2000) $vip += 5;
            if ($o['total'] > 3000) $vip += 5;
            if ($o['total'] > 4000) $vip += 5;
            if ($o['total'] > 5000) $vip += 5;
        }

        return $totalRevenue + $vip;
    }
}
