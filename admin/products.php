<?php
// This file contains product data - in real app, this would come from database

$products = [
    [
        'id' => 1,
        'name' => 'Laptop',
        'img' => 'images/A2.png',
        'description' => 'Learn Angelscript programming.',
        'price' => 200
    ],
    [
        'id' => 2,
        'name' => 'AI Basics',
        'img' => 'images/A3.png',
        'description' => 'Introductory AI concepts.',
        'price' => 300
    ],
    [
        'id' => 3,
        'name' => 'Robotics',
        'img' => 'images/A4.png',
        'description' => 'Introduction to robotics and automation.',
        'price' => 250
    ],
    [
        'id' => 4,
        'name' => 'Robotics',
        'img' => 'images/A5.png',
        'description' => 'Introduction to robotics and automation.',
        'price' => 180
    ],
    [
        'id' => 5,
        'name' => 'Robotics',
        'img' => 'images/A6.png',
        'description' => 'Introduction to robotics and automation.',
        'price' => 220
    ],
    [
        'id' => 6,
        'name' => 'Robotics',
        'img' => 'images/A7.png',
        'description' => 'Introduction to robotics and automation.',
        'price' => 300
    ],
    [
        'id' => 7,
        'name' => 'Robotics',
        'img' => 'images/A8.png',
        'description' => 'Introduction to robotics and automation.',
        'price' => 175
    ],
    [
        'id' => 8,
        'name' => 'Robotics',
        'img' => 'images/A9.png',
        'description' => 'Introduction to robotics and automation.',
        'price' => 190
    ],
    [
        'id' => 9,
        'name' => 'Robotics',
        'img' => 'images/A10.png',
        'description' => 'Introduction to robotics and automation.',
        'price' => 280
    ],
    [
        'id' => 10,
        'name' => 'Robotics',
        'img' => 'images/A11.png',
        'description' => 'Introduction to robotics and automation.',
        'price' => 260
    ],
    [
        'id' => 11,
        'name' => 'Robotics',
        'img' => 'images/A12.png',
        'description' => 'Introduction to robotics and automation.',
        'price' => 210
    ],
    [
        'id' => 12,
        'name' => 'Robotics',
        'img' => 'images/A13.png',
        'description' => 'Introduction to robotics and automation.',
        'price' => 230
    ],
    [
        'id' => 13,
        'name' => 'Robotics',
        'img' => 'images/A14.png',
        'description' => 'Introduction to robotics and automation.',
        'price' => 295
    ],
    [
        'id' => 14,
        'name' => 'Robotics',
        'img' => 'images/A15.png',
        'description' => 'Introduction to robotics and automation.',
        'price' => 170
    ],
    [
        'id' => 15,
        'name' => 'Robotics',
        'img' => 'images/A16.png',
        'description' => 'Introduction to robotics and automation.',
        'price' => 170
    ],
    // Add all other products from your original array...
    // I'm showing a few for brevity
];

// Convert to JSON for JavaScript
$products_json = json_encode($products);
?>