# Attack-Defense Mechanisms in Computer Networks

## Project Overview
This project is an educational tool designed to showcase various attack and defense mechanisms in the realm of computer network security. The primary focus is on web application vulnerabilities, demonstrating common cyber attacks and how to effectively mitigate them.

## Contents
1. [SQL Injection](#sql-injection)
2. [Cross-Site Scripting (XSS)](#cross-site-scripting-xss)
3. [Directory Traversal](#directory-traversal)
4. [Brute-Force Attacks](#brute-force-attacks)
5. [DDoS Attack Simulation and Network Layer Protection](#ddos-attack-simulation-and-network-layer-protection)

### SQL Injection
- **File**: `search.php`
- Demonstrates how SQL Injection attacks can occur in web applications and how they can be mitigated using prepared statements in PHP.

### Cross-Site Scripting (XSS)
- **File**: `comments.php`
- Showcases an XSS vulnerability in a comment system and its mitigation through proper output sanitization using PHP's `htmlspecialchars()` function.

### Directory Traversal
- **File**: `files.php`
- Exhibits a directory traversal vulnerability and how it can be prevented by sanitizing and validating file paths in PHP.

### Brute-Force Attacks
- **File**: `admin_login.php`
- Simulates a login system vulnerable to brute-force attacks and demonstrates a basic rate-limiting mechanism to mitigate such attacks.

## Setup and Running
- Docker with Docker Compose enabled system is required, `docker-compose up -d --build` will get the project up and running.

## Contributions
This project is designed for educational purposes. Contributions and suggestions for adding more features or improving existing ones are welcome.

## License
This project is open-sourced under the MIT License.

## Acknowledgments
Special thanks to the contributors and educators in the field of web security and network protection for their invaluable resources and insights.
