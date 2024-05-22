
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Form</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            .body {
                margin: 0;
                font-family: Arial, sans-serif;
                background: #f4f4f4;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .login-container {
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                width: 300px;
            }

            .title {
                text-align: center;
                color: #333;
            }

            .input-group {
                margin-bottom: 20px;
            }

            .input {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box; /* makes sure the padding doesn't affect the width */
            }

            .input:focus {
                border-color: #666;
            }

            .label {
                display: block;
                margin-bottom: 5px;
            }

            .actions {
                text-align: right;
            }

            .button {
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .button-submit {
                background-color: #5C67F2;
                color: white;
            }

            .button-submit:hover {
                background-color: #4a54e1;
            }

            .button-cancel {
                background-color: #ccc;
                margin-right: 10px;
            }

            .button-cancel:hover {
                background-color: #bbb;
            }
        </style>
    </head>
    <body class="body">
        <div class="login-container">
            <h2 class="title">Welcome to Authentication</h2>
            <form class="login-form" action="#" method="POST">
                <div class="input-group">
                    <label for="email" class="label">Email:</label>
                    <input type="email" id="email" name="email" class="input" required placeholder="Enter your email">
                </div>
                <div class="input-group">
                    <label for="password" class="label">Password:</label>
                    <input type="password" id="password" name="password" class="input" required placeholder="Enter your password">
                </div>
                <div class="actions">
                    <button type="submit" class="button button-submit">Connect</button>
                    <button type="button" class="button button-cancel">Cancel</button>
                </div>
            </form>
        </div>
    </body>
</html>

