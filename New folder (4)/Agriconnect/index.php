<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriConnect - Contract Based Farming Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">AgriConnect</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#how-it-works">How It Works</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-success text-white px-4" href="register.php">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold">Connect, Grow, and Prosper Together</h1>
                    <p class="lead">Join our platform where farmers and buyers collaborate for sustainable agriculture through contract farming.</p>
                    <div class="hero-buttons">
                        <a href="register.php" class="btn btn-primary btn-lg me-3">Join as Farmer</a>
                        <a href="register.php" class="btn btn-outline-primary btn-lg">Join as Buyer</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="assets/images/image.png" alt="Sustainable Farming" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section id="features" class="py-2">
        <div class="container">
            <h2 class="text-center mb-1">Why Choose AgriConnect?</h2>
            <div class="text-center">
                <img src="assets/images/9.jpg" alt="AgriConnect Features" class="img-fluid feature-banner rounded">
            </div>
            <div class="row g-2">
                <div class="col-md-4">
                    <div class="feature-card text-center p-4 h-100">
                        <img src="assets/images/contract-farming.jpg" alt="Secure Contracts" class="feature-image mb-3">
                        <i class="fas fa-handshake fa-3x mb-3 text-primary"></i>
                        <h3>Secure Contracts</h3>
                        <p>Transparent and secure contract management between farmers and buyers. Digital signatures, clear terms, and automated compliance tracking ensure trust and reliability.</p>
                        <ul class="list-unstyled text-start mt-3">
                            <li><i class="fas fa-check text-success me-2"></i>Digital contract management</li>
                            <li><i class="fas fa-check text-success me-2"></i>Secure payment system</li>
                            <li><i class="fas fa-check text-success me-2"></i>Legal compliance support</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center p-4 h-100">
                        <img src="assets/images/fair-price.jpg" alt="Fair Pricing" class="feature-image mb-4">
                        <i class="fas fa-money-bill-wave fa-3x mb-3 text-primary"></i>
                        <h3>Fair Pricing</h3>
                        <p>Get the best market prices and secure payments for your produce. Real-time market insights and transparent pricing mechanisms ensure fair deals for all parties.</p>
                        <ul class="list-unstyled text-start mt-3">
                            <li><i class="fas fa-check text-success me-2"></i>Market price analytics</li>
                            <li><i class="fas fa-check text-success me-2"></i>Price negotiation platform</li>
                            <li><i class="fas fa-check text-success me-2"></i>Automated payments</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center p-4 h-100">
                        <img src="assets/images/communication.jpg" alt="Direct Communication" class="feature-image mb-4">
                        <i class="fas fa-comments fa-3x mb-3 text-primary"></i>
                        <h3>Direct Communication</h3>
                        <p>Real-time chat between farmers and buyers for better collaboration. Built-in translation, file sharing, and notification systems keep everyone connected.</p>
                        <ul class="list-unstyled text-start mt-3">
                            <li><i class="fas fa-check text-success me-2"></i>Real-time messaging</li>
                            <li><i class="fas fa-check text-success me-2"></i>Document sharing</li>
                            <li><i class="fas fa-check text-success me-2"></i>Multi-language support</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Additional Benefits -->
            <div class="row mt-4">
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="benefit-card text-center p-3">
                        <i class="fas fa-mobile-alt fa-2x mb-3 text-success"></i>
                        <h5>Mobile App Support</h5>
                        <p>Access anywhere, anytime with our mobile application</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="benefit-card text-center p-3">
                        <i class="fas fa-shield-alt fa-2x mb-3 text-success"></i>
                        <h5>Secure Platform</h5>
                        <p>Advanced security measures to protect your data</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="benefit-card text-center p-3">
                        <i class="fas fa-headset fa-2x mb-3 text-success"></i>
                        <h5>24/7 Support</h5>
                        <p>Dedicated support team for all your queries</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="benefit-card text-center p-3">
                        <i class="fas fa-chart-line fa-2x mb-3 text-success"></i>
                        <h5>Market Insights</h5>
                        <p>Regular updates on market trends and prices</p>
                    </div>
                </div>
            </div>

            <!-- Testimonial Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <h4 class="text-center mb-4">What Our Users Say</h4>
                    <div class="testimonial-carousel">
                        <div class="testimonial-card text-center p-4 mx-2">
                            <i class="fas fa-quote-left fa-2x mb-3 text-primary"></i>
                            <p class="testimonial-text">"AgriConnect has transformed how we manage our farming contracts. The platform is intuitive and reliable."</p>
                            <p class="testimonial-author">- John D., Farmer</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <h4 class="mb-4">Trusted by Farmers and Buyers Across the Country</h4>
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <div class="stat-card p-3">
                            <i class="fas fa-users fa-2x mb-2 text-primary"></i>
                            <h3>5000+</h3>
                            <p>Active Users</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card p-3">
                            <i class="fas fa-handshake fa-2x mb-2 text-primary"></i>
                            <h3>2000+</h3>
                            <p>Successful Contracts</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card p-3">
                            <i class="fas fa-map-marker-alt fa-2x mb-2 text-primary"></i>
                            <h3>50+</h3>
                            <p>Districts Covered</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">How It Works?</h2>
            <div class="text-center mb-4">
                <p class="lead">Our simple 4-step process makes agricultural partnerships easy and efficient</p>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="step-card text-center">
                        <div class="step-number">1</div>
                        <h4>Sign Up</h4>
                        <p>Create your account as a farmer or buyer</p>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check-circle text-success"></i> Quick registration</li>
                            <li><i class="fas fa-check-circle text-success"></i> Profile verification</li>
                            <li><i class="fas fa-check-circle text-success"></i> Choose your role</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card text-center">
                        <div class="step-number">2</div>
                        <h4>Connect</h4>
                        <p>Find potential partners and discuss terms</p>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check-circle text-success"></i> Browse profiles</li>
                            <li><i class="fas fa-check-circle text-success"></i> Direct messaging</li>
                            <li><i class="fas fa-check-circle text-success"></i> Negotiate terms</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card text-center">
                        <div class="step-number">3</div>
                        <h4>Contract</h4>
                        <p>Create and manage farming contracts</p>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check-circle text-success"></i> Digital contracts</li>
                            <li><i class="fas fa-check-circle text-success"></i> Secure signatures</li>
                            <li><i class="fas fa-check-circle text-success"></i> Terms management</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card text-center">
                        <div class="step-number">4</div>
                        <h4>Grow</h4>
                        <p>Fulfill contracts and grow your business</p>
                        <ul class="list-unstyled mt-3">
                            <li><i class="fas fa-check-circle text-success"></i> Track progress</li>
                            <li><i class="fas fa-check-circle text-success"></i> Secure payments</li>
                            <li><i class="fas fa-check-circle text-success"></i> Build reputation</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <p class="text-muted">Join thousands of successful agricultural partnerships on AgriConnect</p>
                <a href="register.php" class="btn btn-primary btn-lg mt-3">Get Started Today</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer bg-dark text-light py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>AgriConnect</h5>
                    <p>Connecting farmers and buyers for a sustainable future.</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#features">Features</a></li>
                        <li><a href="#how-it-works">How It Works</a></li>
                        <li><a href="login.html">Login</a></li>
                        <li><a href="signup.html">Sign Up</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p>Email: support@agriconnect.com</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>