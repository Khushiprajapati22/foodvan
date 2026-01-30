<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto-Fix Image Paths - SpicyMonk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            max-width: 700px;
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }
        h1 {
            color: #e74c3c;
            margin-bottom: 10px;
        }
        .subtitle {
            color: #666;
            margin-bottom: 30px;
        }
        .warning-box {
            background: #fff3cd;
            border: 2px solid #ffc107;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .success-box {
            background: #d4edda;
            border: 2px solid #28a745;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .error-box {
            background: #f8d7da;
            border: 2px solid #dc3545;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .fix-button {
            background: #e74c3c;
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            width: 100%;
            transition: all 0.3s;
        }
        .fix-button:hover {
            background: #c0392b;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
        }
        .fix-button:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #667eea;
            text-decoration: none;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
        ul {
            text-align: left;
            line-height: 1.8;
        }
        .code {
            background: #f4f4f4;
            padding: 2px 6px;
            border-radius: 3px;
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔧 Auto-Fix Image Paths</h1>
        <p class="subtitle">Automatically add .png extensions to all product image paths</p>
        
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fix_images'])) {
            require_once 'db.php';
            
            echo "<div class='success-box'>";
            echo "<h2>🚀 Fixing Image Paths...</h2>";
            
            $updates = [
                1 => 'assets/images/dish/Dish-2.png',
                2 => 'assets/images/dish/Dish-3.png',
                3 => 'assets/images/dish/Dish-4.png',
                4 => 'assets/images/dish/bev-1.png',
                5 => 'assets/images/dish/bev-2.png',
                6 => 'assets/images/dish/bev-3.png',
                7 => 'assets/images/dish/4.png',
                8 => 'assets/images/dish/Dish-5.png',
                9 => 'assets/images/dish/spicy-noodles-black.png',
                10 => 'assets/images/dish/spicy-noodles-black.png',
                11 => 'assets/images/dish/Dish-5.png',
                12 => 'assets/images/dish/4.png'
            ];
            
            $successCount = 0;
            $errorCount = 0;
            
            echo "<ul>";
            foreach ($updates as $id => $newPath) {
                $stmt = $conn->prepare("UPDATE products SET image_path = ? WHERE id = ?");
                $stmt->bind_param("si", $newPath, $id);
                
                if ($stmt->execute()) {
                    echo "<li>✅ Updated product ID $id to <span class='code'>$newPath</span></li>";
                    $successCount++;
                } else {
                    echo "<li>❌ Failed to update product ID $id</li>";
                    $errorCount++;
                }
                $stmt->close();
            }
            echo "</ul>";
            
            echo "<p><strong>Summary:</strong></p>";
            echo "<p>✅ Successfully updated: $successCount products</p>";
            if ($errorCount > 0) {
                echo "<p>❌ Failed: $errorCount products</p>";
            }
            
            echo "<p style='margin-top: 20px;'><strong>Next Steps:</strong></p>";
            echo "<ol style='text-align: left;'>";
            echo "<li>Visit <a href='test_images.php' style='color: #e74c3c;'>test_images.php</a> to verify all images are working</li>";
            echo "<li>Clear your browser cache (Ctrl+Shift+Delete or Ctrl+F5)</li>";
            echo "<li>Check your <a href='menu.php' style='color: #e74c3c;'>menu page</a></li>";
            echo "</ol>";
            
            echo "</div>";
            
            $conn->close();
        } else {
            ?>
            
            <div class="warning-box">
                <h3>⚠️ What This Will Do:</h3>
                <p>This script will automatically update your database to add <span class="code">.png</span> extensions to all product image paths.</p>
                <p><strong>Example:</strong></p>
                <ul>
                    <li>Before: <span class="code">assets/images/dish/Dish-2</span></li>
                    <li>After: <span class="code">assets/images/dish/Dish-2.png</span></li>
                </ul>
                <p><strong>Products to be updated:</strong> 12 items</p>
            </div>
            
            <form method="POST">
                <button type="submit" name="fix_images" class="fix-button">
                    🔧 Fix All Image Paths Now
                </button>
            </form>
            
            <div style="margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 8px;">
                <h3>📋 Alternative Method</h3>
                <p>If you prefer to do it manually:</p>
                <ol style="text-align: left;">
                    <li>Open <strong>phpMyAdmin</strong></li>
                    <li>Select <span class="code">spicymonk</span> database</li>
                    <li>Go to <strong>SQL</strong> tab</li>
                    <li>Run the <span class="code">fix_image_paths_complete.sql</span> file</li>
                </ol>
            </div>
            
            <?php
        }
        ?>
        
        <a href="index.php" class="back-link">← Back to Home</a>
        <span style="margin: 0 10px;">|</span>
        <a href="test_images.php" class="back-link">🔍 Test Images</a>
    </div>
</body>
</html>
