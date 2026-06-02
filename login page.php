<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kisan Connect Login Flow</title>
    <!-- Load Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons for visuals -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-yellow': '#facc15',
                        'background-dark': '#4b5563',
                        'farm-green': '#15803d'
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-out forwards',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        .farm-bg {
            background-image: url('https://i.supaimg.com/4f2b3438-4977-4616-a55a-0f95187a60c8.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
            z-index: 1;
        }
        .farm-bg::before {
            content: "";
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: rgba(0, 0, 0, 0.65);
            z-index: 0;
        }
        .form-input {
            background-color: transparent;
            border-bottom: 2px solid rgba(255, 255, 255, 0.5);
            color: white;
            padding-bottom: 8px;
            transition: border-color 0.3s;
        }
        .form-input:focus {
            border-color: #facc15;
            outline: none;
        }
        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }
        /* Loader Spinner */
        .loader {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 4px solid #facc15;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="farm-bg font-sans min-h-screen flex flex-col items-center justify-center p-4 overflow-hidden">

    <!-- Dynamic Content Container -->
    <div class="z-10 w-full max-w-sm mx-auto relative min-h-[500px] flex flex-col justify-center">
        
        <!-- Logo -->
        <div id="logoContainer" class="flex justify-center mb-8 transition-all duration-500">
            <div class="relative group">
                <img 
                    src="https://i.supaimg.com/e409a04b-622b-45c4-b801-446ac1064f93.png" 
                    alt="Kisan Connect Logo" 
                    class="rounded-full shadow-2xl border-4 border-white/20 w-29 h-32 object-cover bg-white/10 backdrop-blur-sm p-3"
                />
                <div class="absolute -bottom-2 w-full text-center">
                    <span class="bg-primary-yellow text-black text-xs font-bold px-2 py-1 rounded-full shadow-sm">Kisan Connect</span>
                </div>
            </div>
        </div>

        <!-- VIEW 1: LOGIN FORM -->
        <div id="loginView" class="animate-fade-in w-full bg-black/20 backdrop-blur-sm p-6 rounded-2xl border border-white/10 shadow-2xl">
            <form id="loginForm" class="space-y-6">
                <h2 class="text-white text-xl font-bold text-center mb-4">Farmer Login</h2>
                
                <!-- Error Message Container -->
                <div id="errorMessage" class="hidden bg-red-500/80 text-white text-xs p-3 rounded-lg text-center"></div>

                <div>
                    <label for="email" class="block text-white text-sm mb-2 opacity-90">Email ID or Phone</label>
                    <div class="relative">
                        <i data-lucide="user" class="absolute left-0 bottom-3 text-white/50 w-5 h-5"></i>
                        <input type="text" id="email" placeholder="farmer@kisan.com" class="form-input w-full pl-8" required>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-white text-sm mb-2 opacity-90">Password</label>
                    <div class="relative">
                        <i data-lucide="lock" class="absolute left-0 bottom-3 text-white/50 w-5 h-5"></i>
                        <input type="password" id="password" placeholder="••••••••" class="form-input w-full pl-8" required>
                    </div>
                </div>

                <button type="submit" class="w-full bg-primary-yellow text-black font-bold py-3 px-4 rounded-xl shadow-lg hover:bg-yellow-400 transition transform hover:scale-[1.02] flex justify-center items-center gap-2">
                    <span>Generate OTP</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>
        </div>

        <!-- VIEW 2: OTP FORM (Hidden Initially) -->
        <div id="otpView" class="hidden w-full bg-black/20 backdrop-blur-sm p-6 rounded-2xl border border-white/10 shadow-2xl">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-white/10 mb-4 text-primary-yellow">
                    <i data-lucide="smartphone" class="w-6 h-6"></i>
                </div>
                <h2 class="text-white text-xl font-bold">Verification</h2>
                <p class="text-gray-300 text-sm mt-2">We sent a code to your registered number.</p>
                <p class="text-primary-yellow text-sm font-bold mt-1">OTP: 1234</p>
            </div>

            <form id="otpForm" class="space-y-6">
                <div class="flex justify-center gap-3">
                    <input type="text" maxlength="1" class="otp-digit w-12 h-14 text-center text-xl font-bold bg-white/10 border-2 border-white/20 rounded-lg text-white focus:border-primary-yellow focus:outline-none focus:bg-white/20 transition" autofocus>
                    <input type="text" maxlength="1" class="otp-digit w-12 h-14 text-center text-xl font-bold bg-white/10 border-2 border-white/20 rounded-lg text-white focus:border-primary-yellow focus:outline-none focus:bg-white/20 transition">
                    <input type="text" maxlength="1" class="otp-digit w-12 h-14 text-center text-xl font-bold bg-white/10 border-2 border-white/20 rounded-lg text-white focus:border-primary-yellow focus:outline-none focus:bg-white/20 transition">
                    <input type="text" maxlength="1" class="otp-digit w-12 h-14 text-center text-xl font-bold bg-white/10 border-2 border-white/20 rounded-lg text-white focus:border-primary-yellow focus:outline-none focus:bg-white/20 transition">
                </div>
                
                <button type="submit" class="w-full bg-primary-yellow text-black font-bold py-3 px-4 rounded-xl shadow-lg hover:bg-yellow-400 transition transform hover:scale-[1.02]">
                    Verify & Login
                </button>
                
                <button type="button" id="backToLogin" class="w-full text-white text-sm py-2 hover:text-white/80 transition">
                    ← Back to Login
                </button>
            </form>
        </div>

        <!-- LOADING OVERLAY -->
        <div id="loadingOverlay" class="hidden absolute inset-0 z-50 flex flex-col items-center justify-center bg-black/80 backdrop-blur-sm rounded-2xl">
            <div class="loader mb-4"></div>
            <p id="loadingText" class="text-white font-medium animate-pulse">Processing...</p>
        </div>

    </div>

    <!-- Scripts for Logic -->
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Element References
        const loginForm = document.getElementById('loginForm');
        const otpForm = document.getElementById('otpForm');
        const loginView = document.getElementById('loginView');
        const otpView = document.getElementById('otpView');
        const loadingOverlay = document.getElementById('loadingOverlay');
        const loadingText = document.getElementById('loadingText');
        const errorMessage = document.getElementById('errorMessage');
        const otpInputs = document.querySelectorAll('.otp-digit');

        // Helper: Show Loader
        function showLoader(message = "Processing...") {
            loadingText.textContent = message;
            loadingOverlay.classList.remove('hidden');
        }

        // Helper: Hide Loader
        function hideLoader() {
            loadingOverlay.classList.add('hidden');
        }

        // Helper: Show Error
        function showError(msg) {
            errorMessage.textContent = msg;
            errorMessage.classList.remove('hidden');
            setTimeout(() => {
                errorMessage.classList.add('hidden');
            }, 3000);
        }

        // 1. Handle Login Submission
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            // Get form values
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            showLoader("Connecting to Database...");

            try {
                // Send data to PHP script
                const response = await fetch('save_user.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email: email, password: password })
                });

                // In a real environment, we parse the JSON. 
                // For this demo if PHP isn't running, it might fail, so we catch errors.
                const data = await response.json();

                if (data.status === 'success') {
                    // Success! Proceed to OTP flow
                    setTimeout(() => {
                        hideLoader();
                        loginView.classList.add('hidden');
                        otpView.classList.remove('hidden');
                        otpView.classList.add('animate-fade-in');
                        otpInputs[0].focus();
                    }, 500);
                } else {
                    // PHP returned an error
                    hideLoader();
                    showError("DB Error: " + data.message);
                }

            } catch (error) {
                console.error("Error:", error);
                hideLoader();
                // If running in a preview without PHP, we show a specific message
                showError("Could not connect to PHP. Ensure 'save_user.php' is on your server.");
                
                // FALLBACK FOR PREVIEW MODE (So you can see the UI transition)
                // Remove this block in production
                /*
                setTimeout(() => {
                   loginView.classList.add('hidden');
                   otpView.classList.remove('hidden');
                   otpView.classList.add('animate-fade-in');
                }, 1000);
                */
            }
        });

        // OTP Input Logic
        otpInputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if(e.target.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }
            });
            input.addEventListener('keydown', (e) => {
                if(e.key === 'Backspace' && e.target.value === '' && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });

        // 2. Handle OTP Submission
        otpForm.addEventListener('submit', (e) => {
            e.preventDefault();
            let enteredOtp = '';
            otpInputs.forEach(input => enteredOtp += input.value);

            if (enteredOtp.length !== 4) {
                alert("Please enter a 4-digit OTP");
                return;
            }

            showLoader("Verifying OTP...");
            setTimeout(() => {
                loadingText.textContent = "Login Successful!";
                loadingText.classList.remove('animate-pulse');
                loadingText.classList.add('text-green-400');
                
                setTimeout(() => {
                    hideLoader();
                    window.location.href = "login page 2.html";
                }, 1000);
            }, 1500);
        });

        // Back button
        document.getElementById('backToLogin').addEventListener('click', () => {
            otpView.classList.add('hidden');
            loginView.classList.remove('hidden');
            loginView.classList.add('animate-fade-in');
        });

    </script>
    <?php
// save_user.php

// Allow requests from any origin (CORS) - useful for testing
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

// Database Configuration
$servername = "Abhiparth"; // As requested
$username   = "root";      // Change this to your database username
$password   = "";          // Change this to your database password
$dbname     = "kisan_connect_db"; // We will create this database

// 1. Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

// 2. Check Connection
if ($conn->connect_error) {
    echo json_encode([
        "status" => "error", 
        "message" => "Connection failed: " . $conn->connect_error
    ]);
    exit();
}

// 3. Receive JSON Data from the HTML Form
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

// Check if data is valid
if (isset($input['email']) && isset($input['password'])) {
    
    $email = $input['email'];
    $raw_password = $input['password'];

    // SECURITY: Hash the password before saving (Never save plain text passwords)
    $password_hash = password_hash($raw_password, PASSWORD_DEFAULT);

    // SECURITY: Use Prepared Statements to prevent SQL Injection
    $stmt = $conn->prepare("INSERT INTO users (email, password_hash, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("ss", $email, $password_hash);

    // Execute the query
    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success", 
            "message" => "User data saved successfully",
            "user_id" => $stmt->insert_id
        ]);
    } else {
        echo json_encode([
            "status" => "error", 
            "message" => "Error saving data: " . $stmt->error
        ]);
    }

    $stmt->close();

} else {
    echo json_encode([
        "status" => "error", 
        "message" => "Invalid input data"
    ]);
}

$conn->close();
?>
</body>
</html>