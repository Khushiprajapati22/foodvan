<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Path Diagnostics - SpicyMonk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #e74c3c;
            border-bottom: 3px solid #e74c3c;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #e74c3c;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .status-yes {
            color: #27ae60;
            font-weight: bold;
        }
        .status-no {
            color: #e74c3c;
            font-weight: bold;
        }
        .image-preview {
            max-width: 100px;
            max-height: 100px;
            border: 2px solid #ddd;
            border-radius: 4px;
        }
        .error-image {
            background: #ffebee;
            padding: 10px;
            border: 2px dashed #e74c3c;
            border-radius: 4px;
            font-size: 12px;
            color: #c62828;
        }
        .fix-button {
            background: #27ae60;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin: 20px 0;
        }
        .fix-button:hover {
            background: #229954;
        }
        .alert {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .alert-warning {
            background: #fff3cd;
            border: 1px solid #ffc107;
            color: #856404;
        }
        .alert-success {
            background: #d4edda;
            border: 1px solid #28a745;
            color: #155724;
        }
        .code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 SpicyMonk Image Path Diagnostics</h1>
        
        <?php
        require_once 'db.php';
        
        echo "<div class='alert alert-warning'>";
        echo "<strong>⚠️ Checking Image Paths</strong><br>";
        echo "This page will help you identify why product images are not loading.";
        echo "</div>";
        
        $sql = "SELECT id, title, image_path FROM products ORDER BY id";
        $result = $conn->query($sql);
        
        $totalProducts = 0;
        $workingImages = 0;
        $brokenImages = 0;
        
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Product Title</th>";
        echo "<th>Image Path (from DB)</th>";
        echo "<th>File Exists?</th>";
        echo "<th>Has Extension?</th>";
        echo "<th>Image Preview</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        
        while ($row = $result->fetch_assoc()) {
            $totalProducts++;
            $imagePath = $row['image_path'];
            $fileExists = file_exists($imagePath);
            $hasExtension = (pathinfo($imagePath, PATHINFO_EXTENSION) !== '');
            
            if ($fileExists) {
                $workingImages++;
            } else {
                $brokenImages++;
            }
            
            echo "<tr>";
            echo "<td><strong>" . $row['id'] . "</strong></td>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td><span class='code'>" . htmlspecialchars($imagePath) . "</span></td>";
            echo "<td class='" . ($fileExists ? "status-yes" : "status-no") . "'>";
            echo $fileExists ? "✅ YES" : "❌ NO";
            echo "</td>";
            echo "<td class='" . ($hasExtension ? "status-yes" : "status-no") . "'>";
            echo $hasExtension ? "✅ YES" : "❌ NO";
            echo "</td>";
            echo "<td>";
            
            if ($fileExists) {
                echo "<img src='" . htmlspecialchars($imagePath) . "' class='image-preview' alt='Preview'>";
            } else {
                // Try to find the file with .png extension
                $possiblePath = $imagePath . '.png';
                if (file_exists($possiblePath)) {
                    echo "<div class='error-image'>❌ Path missing .png<br>";
                    echo "Found at: <span class='code'>" . htmlspecialchars($possiblePath) . "</span></div>";
                } else {
                    echo "<div class='error-image'>❌ File not found</div>";
                }
            }
            
            echo "</td>";
            echo "</tr>";
        }
        
        echo "</tbody>";
        echo "</table>";
        
        // Summary
        echo "<div style='margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 8px;'>";
        echo "<h2>📊 Summary</h2>";
        echo "<p><strong>Total Products:</strong> $totalProducts</p>";
        echo "<p><strong>Working Images:</strong> <span class='status-yes'>$workingImages</span></p>";
        echo "<p><strong>Broken Images:</strong> <span class='status-no'>$brokenImages</span></p>";
        
        if ($brokenImages > 0) {
            echo "<div class='alert alert-warning' style='margin-top: 20px;'>";
            echo "<h3>🔧 How to Fix:</h3>";
            echo "<ol>";
            echo "<li>Open <strong>phpMyAdmin</strong></li>";
            echo "<li>Select the <span class='code'>spicymonk</span> database</li>";
            echo "<li>Click on the <strong>SQL</strong> tab</li>";
            echo "<li>Copy and paste the contents of <span class='code'>fix_image_paths_complete.sql</span></li>";
            echo "<li>Click <strong>Go</strong> to execute</li>";
            echo "<li>Refresh this page to verify the fix</li>";
            echo "</ol>";
            echo "<p><strong>Alternative:</strong> Re-import the updated <span class='code'>spicymonk.sql</span> file</p>";
            echo "</div>";
        } else {
            echo "<div class='alert alert-success' style='margin-top: 20px;'>";
            echo "<h3>✅ All Images Are Working!</h3>";
            echo "<p>If images still don't show on your website, check:</p>";
            echo "<ul>";
            echo "<li>Browser cache (try Ctrl+F5 to hard refresh)</li>";
            echo "<li>File permissions on the <span class='code'>assets/images/dish/</span> folder</li>";
            echo "<li>Console errors in browser Developer Tools (F12)</li>";
            echo "</ul>";
            echo "</div>";
        }
        echo "</div>";
        
        $conn->close();
        ?>
        
        <div style="margin-top: 30px; padding: 20px; background: #e8f5e9; border-radius: 8px;">
            <h3>🎯 Quick Actions</h3>
            <p><a href="index.php" style="color: #e74c3c; text-decoration: none; font-weight: bold;">← Back to Home</a></p>
            <p><a href="menu.php" style="color: #e74c3c; text-decoration: none; font-weight: bold;">→ View Menu Page</a></p>
            <p><a href="javascript:location.reload()" style="color: #27ae60; text-decoration: none; font-weight: bold;">🔄 Refresh This Page</a></p>
        </div>
    </div>
</body>
</html>