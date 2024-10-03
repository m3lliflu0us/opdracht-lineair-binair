<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoek Algoritmes</title>
</head>

<body>
    <h1>Zoek Algoritmes</h1>
    <form method="post">
        <label for="target">Voer een target in:</label>
        <input type="number" id="target" name="target" required>
        <button type="submit">Zoeken</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $target = intval($_POST["target"]);

        class LinearSearch
        {
            public function search($array, $target)
            {
                foreach ($array as $element) {
                    if ($element == $target) {
                        return true;
                    }
                }
                return false;
            }
        }

        class BinarySearch
        {
            public function search($array, $target, $low, $high)
            {
                if ($low > $high) {
                    return false;
                }
                $mid = intdiv($low + $high, 2);
                if ($array[$mid] == $target) {
                    return true;
                } elseif ($array[$mid] > $target) {
                    return $this->search($array, $target, $low, $mid - 1);
                } else {
                    return $this->search($array, $target, $mid + 1, $high);
                }
            }
        }

        // Genereren van een gesorteerde array van 10.000 willekeurige nummers
        $array = range(1, 10000);
        shuffle($array);
        sort($array);

        // Lineair zoeken
        $linearSearch = new LinearSearch();
        $start_time = microtime(true);
        $linear_result = $linearSearch->search($array, $target);
        $linear_time = microtime(true) - $start_time;

        // Binair zoeken
        $binarySearch = new BinarySearch();
        $start_time = microtime(true);
        $binary_result = $binarySearch->search($array, $target, 0, count($array) - 1);
        $binary_time = microtime(true) - $start_time;

        echo "<h2>Resultaten</h2>";
        echo "<p>Lineair zoeken vond het target: " . ($linear_result ? 'true' : 'false') . "</p>";
        echo "<p>Lineair zoeken duurde: " . $linear_time . " seconden</p>";
        echo "<p>Binair zoeken vond het target: " . ($binary_result ? 'true' : 'false') . "</p>";
        echo "<p>Binair zoeken duurde: " . $binary_time . " seconden</p>";
    }
    ?>
</body>

</html>