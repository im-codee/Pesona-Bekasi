<?php

$data = [
    [-6.329153, 106.967091],  // Go Wet Waterpark
    [-6.1535487, 106.9758293],  // Transera Waterpark
    [-6.3160495, 106.9744366],  // Fun Park Waterboom
    [-6.1558544, 107.009212],  // Southlake Adventure Park
    [-6.3253187, 107.0370386],  // Grand Splash Waterpark
];

$names = [
    "Go Wet Waterpark",
    "Transera Waterpark",
    "Fun Park Waterboom",
    "Southlake Adventure Park",
    "Grand Splash Waterpark",
];

$k = 2;

// Inisialisasi centroid awal secara acak
$centroids = [
    $data[0],
    $data[1],
];

// Fungsi untuk menghitung jarak Euclidean
function euclideanDistance($point1, $point2) {
    return sqrt(pow($point1[0] - $point2[0], 2) + pow($point1[1] - $point2[1], 2));
}

// Iterasi K-Means
$maxIterations = 100;
$clusters = [];
for ($iteration = 0; $iteration < $maxIterations; $iteration++) {
    // Reset clusters
    $clusters = array_fill(0, $k, []);

    // Assign data ke centroid terdekat
    foreach ($data as $index => $point) {
        $distances = array_map(fn($centroid) => euclideanDistance($point, $centroid), $centroids);
        $closestCentroid = array_keys($distances, min($distances))[0];
        $clusters[$closestCentroid][] = $index;
    }

    // Hitung centroid baru
    $newCentroids = [];
    foreach ($clusters as $cluster) {
        if (count($cluster) > 0) {
            $latitudes = array_map(fn($index) => $data[$index][0], $cluster);
            $longitudes = array_map(fn($index) => $data[$index][1], $cluster);
            $newCentroids[] = [array_sum($latitudes) / count($latitudes), array_sum($longitudes) / count($longitudes)];
        } else {
            $newCentroids[] = $centroids[array_keys($clusters, $cluster)[0]];
        }
    }

    // Cek konvergensi
    if ($newCentroids == $centroids) {
        break;
    }

    $centroids = $newCentroids;
}

// Output hasil clustering
foreach ($clusters as $clusterId => $cluster) {
    echo "Kluster " . ($clusterId + 1) . ": ";
    echo implode(", ", array_map(fn($index) => $names[$index], $cluster)) . PHP_EOL;
}

// Output centroid
echo "Centroid akhir:\n";
foreach ($centroids as $centroid) {
    echo "[" . implode(", ", $centroid) . "]\n";
}
?>
