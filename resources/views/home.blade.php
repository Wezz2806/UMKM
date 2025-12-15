<?php
session_start();

 
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Desa - Peminjaman Dana</title>
    <style>
        :root {
            --primary: #2E7D32;
            --primary-light: #4CAF50;
            --secondary: #8BC34A;
            --light: #F1F8E9;
            --dark: #1B5E20;
            --text-dark: #333333;
            --text-light: #FFFFFF;
            --shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --border-radius: 8px;
            --spacing-sm: 0.5rem;
            --spacing-md: 1rem;
            --spacing-lg: 2rem;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif; 
            scroll-behavior: smooth;
        }
        
        body {
            background-color: #fafafa;
            color: var(--text-dark);
            line-height: 1.6;
            overflow-x: hidden;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-lg);
        }
        
        /* Header styles */
        header {
            background-color: var(--primary);
            color: var(--text-light);
            padding: var(--spacing-md) 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        header.scrolled {
            padding: var(--spacing-sm) 0;
            background-color: rgba(46, 125, 50, 0.95);
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 var(--spacing-lg);
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
            text-decoration: none;
            color: var(--text-light);
        }
        
        .logo h1 {
            font-size: 1.5rem;
            font-weight: 600;
        }
        
        .logo-icon {
            font-size: 1.8rem;
        }
        
        /* Navigation */
        nav {
            display: flex;
            align-items: center;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
            gap: 1.5rem;
            margin-right: var(--spacing-lg);
        }
        
        .nav-links a {
            color: var(--text-light);
            text-decoration: none;
            font-weight: 500;
            padding: var(--spacing-sm) 0;
            position: relative;
            transition: var(--transition);
        }
        
        .nav-links a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--secondary);
            transition: var(--transition);
        }
        
        .nav-links a:hover {
            color: var(--secondary);
        }
        
        .nav-links a:hover:after {
            width: 100%;
        }
        
        .auth-buttons {
            display: flex;
            gap: var(--spacing-md);
        }
        
        .btn {
            display: inline-block;
            padding: 0.6rem 1.2rem;
            border-radius: var(--border-radius);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            cursor: pointer;
            border: none;
            font-size: 1rem;
        }
        
        .btn-primary {
            background-color: var(--secondary);
            color: var(--text-light);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
        }
        
        .btn-outline {
            background-color: transparent;
            color: var(--text-light);
            border: 1px solid var(--text-light);
        }
        
        .btn-outline:hover {
            background-color: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        
        .menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 1.5rem;
            color: var(--text-light);
        }
        
        /* Hero section */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('/api/placeholder/1200/600') no-repeat center center;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--text-light);
            margin-top: 0;
            position: relative;
        }
        
        .hero-content {
            max-width: 800px;
            padding: var(--spacing-lg);
            animation: fadeIn 1s ease;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .hero h2 {
            font-size: 2.8rem;
            margin-bottom: var(--spacing-md);
            line-height: 1.2;
        }
        
        .hero p {
            font-size: 1.2rem;
            margin-bottom: var(--spacing-lg);
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .hero-buttons {
            display: flex;
            gap: var(--spacing-md);
            justify-content: center;
        }
        
        .btn-large {
            padding: 0.8rem 1.8rem;
            font-size: 1.1rem;
        }
        
        .scroll-down {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
            color: var(--text-light);
            font-size: 2rem;
            cursor: pointer;
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0) translateX(-50%);
            }
            40% {
                transform: translateY(-20px) translateX(-50%);
            }
            60% {
                transform: translateY(-10px) translateX(-50%);
            }
        }
        
        /* Section styling */
        section {
            padding: 4rem 2rem;
            scroll-margin-top: 70px;
        }
        
        .section-light {
            background-color: var(--light);
        }
        
        .section-white {
            background-color: #fff;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-title h2 {
            font-size: 2.2rem;
            color: var(--primary);
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }
        
        .section-title h2:after {
            content: '';
            position: absolute;
            width: 50%;
            height: 3px;
            background-color: var(--secondary);
            bottom: 0;
            left: 25%;
        }
        
        .section-subtitle {
            margin-top: -2rem;
            margin-bottom: 3rem;
            text-align: center;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            color: #666;
        }
        
        /* Features section */
        .features {
            padding: 5rem 0;
        }
        
        .feature-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: var(--spacing-lg);
        }
        
        .feature-card {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: var(--spacing-lg);
            flex: 1 1 300px;
            max-width: 350px;
            transition: var(--transition);
            border-top: 4px solid transparent;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            border-top: 4px solid var(--secondary);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: var(--spacing-md);
            text-align: center;
        }
        
        .feature-card h3 {
            margin-bottom: var(--spacing-md);
            color: var(--dark);
            text-align: center;
        }
        
        /* Loan process */
        .process-steps {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: var(--spacing-lg);
            margin-top: var(--spacing-lg);
        }
        
        .step {
            flex: 1 1 200px;
            max-width: 250px;
            text-align: center;
            position: relative;
        }
        
        .step-number {
            background-color: var(--primary);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--spacing-md);
            position: relative;
            z-index: 2;
            font-size: 1.2rem;
            font-weight: bold;
        }
        
        .step-content {
            padding: var(--spacing-lg);
            background-color: white;
            border-radius: var(--border-radius);
            height: 100%;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .step:hover .step-content {
            transform: translateY(-5px);
        }
        
        .step-title {
            margin-bottom: var(--spacing-sm);
            color: var(--primary);
        }
        
        /* Application form */
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: var(--spacing-lg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }
        
        .form-group {
            margin-bottom: var(--spacing-lg);
        }
        
        label {
            display: block;
            margin-bottom: var(--spacing-sm);
            font-weight: 500;
            color: var(--text-dark);
        }
        
        input, select, textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
        }
        
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(46, 125, 50, 0.2);
        }
        
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: var(--spacing-md);
        }
        
        .form-row .form-group {
            flex: 1 1 45%;
        }
        
        .form-hint {
            font-size: 0.85rem;
            color: #666;
            margin-top: 0.3rem;
        }
        
        .btn-submit {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: var(--transition);
            width: 100%;
        }
        
        .btn-submit:hover {
            background-color: var(--dark);
            transform: translateY(-2px);
        }
        
        /* Testimonials */
        .testimonial-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: var(--spacing-lg);
        }
        
        .testimonial {
            flex: 1 1 300px;
            max-width: 350px;
            background-color: white;
            padding: var(--spacing-lg);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .testimonial:hover {
            transform: translateY(-5px);
        }
        
        .testimonial-text {
            font-style: italic;
            margin-bottom: var(--spacing-md);
            position: relative;
            color: #555;
        }
        
        .testimonial-text:before {
            content: '"';
            font-size: 4rem;
            position: absolute;
            left: -1rem;
            top: -2rem;
            opacity: 0.2;
            color: var(--primary);
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            gap: var(--spacing-md);
        }
        
        .author-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--light);
        }
        
        .author-info h4 {
            margin-bottom: 0.25rem;
            color: var(--primary);
        }
        
        .author-info p {
            font-size: 0.9rem;
            color: #666;
        }
        
        /* Footer */
        footer {
            background-color: var(--dark);
            color: var(--text-light);
            padding: 4rem 0 2rem;
        }
        
        .footer-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: var(--spacing-lg);
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 var(--spacing-lg);
        }
        
        .footer-section {
            flex: 1 1 250px;
        }
        
        .footer-section h3 {
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
            color: var(--secondary);
        }
        
        .footer-section h3:after {
            content: '';
            position: absolute;
            width: 50px;
            height: 2px;
            background-color: var(--secondary);
            bottom: 0;
            left: 0;
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section li {
            margin-bottom: 0.5rem;
        }
        
        .footer-section a {
            color: #ccc;
            text-decoration: none;
            transition: var(--transition);
        }
        
        .footer-section a:hover {
            color: var(--secondary);
            padding-left: 5px;
        }
        
        .footer-contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        
        .contact-icon {
            width: 20px;
            color: var(--secondary);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-link {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }
        
        .social-link:hover {
            background-color: var(--secondary);
            transform: translateY(-3px);
        }
        
        /* Login Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 2000;
            animation: fadeIn 0.3s;
            overflow-y: auto;
        }
        
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: var(--spacing-lg);
            width: 90%;
            max-width: 500px;
            border-radius: var(--border-radius);
            position: relative;
            animation: slideDown 0.4s;
        }
        
        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .close-modal {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 1.5rem;
            cursor: pointer;
            color: #777;
            transition: var(--transition);
        }
        
        .close-modal:hover {
            color: var(--primary);
        }
        
        .modal-header {
            text-align: center;
            margin-bottom: var(--spacing-lg);
        }
        
        .modal-header h2 {
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        
        .modal-header p {
            color: #777;
        }
        
        .login-tabs {
            display: flex;
            margin-bottom: var(--spacing-lg);
            border-bottom: 1px solid #ddd;
        }
        
        .login-tab {
            flex: 1;
            text-align: center;
            padding: 10px;
            cursor: pointer;
            transition: var(--transition);
            border-bottom: 2px solid transparent;
        }
        
        .login-tab.active {
            border-bottom: 2px solid var(--primary);
            color: var(--primary);
            font-weight: 500;
        }
        
        .login-tab:hover {
            background-color: #f9f9f9;
        }
        
        .tab-content {
            display: none;
        }
        
        .tab-content.active {
            display: block;
        }
        
        .password-container {
            position: relative;
        }
        
        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
        }
        
        .forgot-password {
            text-align: right;
            margin-top: 0.5rem;
        }
        
        .forgot-password a {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
        
        .login-divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }
        
        .login-divider span {
            flex: 1;
            height: 1px;
            background-color: #ddd;
        }
        
        .login-divider p {
            padding: 0 10px;
            color: #777;
            font-size: 0.9rem;
        }
        
        .social-login {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: var(--spacing-md);
        }
        
        .social-login-btn {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            cursor: pointer;
            transition: var(--transition);
            background-color: white;
        }
        
        .social-login-btn:hover {
            background-color: #f9f9f9;
        }
        
        .register-link {
            text-align: center;
            margin-top: var(--spacing-md);
            font-size: 0.9rem;
        }
        
        .register-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .register-link a:hover {
            text-decoration: underline;
        }
        
        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            opacity: 0;
            pointer-events: none;
            transition: var(--transition);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 900;
        }
        
        .back-to-top.visible {
            opacity: 1;
            pointer-events: auto;
        }
        
        .back-to-top:hover {
            background-color: var(--dark);
            transform: translateY(-5px);
        }
        
        /* Dashboard Preview */
        .dashboard-preview {
            padding: 4rem 0;
            background-color: #f5f5f5;
        }
        
        .dashboard-container {
            max-width: 1100px;
            margin: 0 auto;
            overflow: hidden;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
        }
        
        .dashboard-img {
            width: 100%;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }
        
        .dashboard-img:hover {
            transform: scale(1.02);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .hero h2 {
                font-size: 2.2rem;
            }
            
            .logo h1 {
                font-size: 1.3rem;
            }
        }
        
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            
            .nav-links {
                position: fixed;
                left: 0;
                right: 0;
                top: 70px;
                flex-direction: column;
                background-color: var(--dark);
                padding: 1rem 0;
                margin: 0;
                height: 0;
                overflow: hidden;
                transition: var(--transition);
                z-index: 1000;
                align-items: center;
            }
            
            .nav-links.active {
                height: auto;
                padding: 1rem 0;
            }
            
            .nav-links li {
                width: 100%;
                text-align: center;
            }
            
            .nav-links a {
                display: block;
                padding: 0.8rem 0;
            }
            
            .auth-buttons {
                margin-top: 1rem;
                width: 100%;
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .hero {
                height: 100vh;
                padding-top: 70px;
            }
            
            .hero-content {
                padding: var(--spacing-md);
            }
            
            .hero h2 {
                font-size: 2.2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
            
            .hero-buttons {
                flex-direction: column;
                gap: 1rem;
            }
            
            .process-steps {
                flex-direction: column;
                align-items: center;
            }
            
            .step {
                max-width: 100%;
                width: 100%;
                margin-bottom: 2rem;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .footer-section {
                flex: 1 1 100%;
                margin-bottom: var(--spacing-md);
            }
            .feature-card{
                flex: 1 1 100%;
                max-width: 100%;
            }
        }
        
        @media (max-width: 480px) {
            .hero h2 {
                font-size: 1.6rem;
            }
            
            .logo h1 {
                font-size: 1.1rem;
            }
            
            .section-title h2 {
                font-size: 1.8rem;
            }
            
            .feature-card, .testimonial {
                flex: 1 1 100%;
                max-width: 100%;
            }
            
            .social-login {
                flex-direction: column;
            }
            /* Pastikan responsif di layar kecil */
@media (max-width: 768px) {
  .navbar {
    flex-direction: column;
    align-items: center;
    padding: 10px;
  }

  .navbar-brand,
  .navbar-menu {
    width: 100%;
    text-align: center;
    margin-bottom: 10px;
  }

  .navbar-button {
    display: block;
    width: 90%;
    margin: 5px auto;
  }
}


        }
    </style>
</head>

<body>
    <!-- Header -->
    <header id="header">
        <div class="header-container">
            <div class="logo-container">
                <a href="#" class="logo">
                    <div class="logo-icon">🌾</div>
                    <h1>DANA UMKM DESA</h1>
                </a>
            </div>

            <div class="menu-toggle" id="menu-toggle">☰</div>
            
            <nav>
                <ul class="nav-links" id="nav-links">
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#program">Program</a></li>
                    <li><a href="#proses">Proses</a></li>
                    <li><a href="login.php">Ajukan</a></li>
                    <li><a href="#testimoni">Testimoni</a></li>
                    <li><a href="#kontak">Kontak</a></li>
                </ul>
                <div class="auth-buttons">
                    
                    <a href ="login.php" class="btn btn-outline">Masuk</a>
                    
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="hero-content">
            <h2>Dukung UMKM Desa, Bangkitkan Ekonomi Lokal</h2>
            <p>Solusi pembiayaan dan pendampingan untuk membantu usaha mikro, kecil, dan menengah di desa Anda berkembang dan mencapai potensi maksimal.</p>
            <div class="hero-buttons">
                <a href="login.php" class="btn btn-primary btn-large">Ajukan Pinjaman</a>
                <a href="#program" class="btn btn-outline btn-large">Pelajari Program</a>
            </div>
        </div>
        <div class="scroll-down" id="scroll-down">↓</div>
    </section>

    <!-- Features Section -->
    <section class="features section-light" id="program">
        <div class="container">
            <div class="section-title">
                <h2>Program Pinjaman Kami</h2>
            </div>
            <p class="section-subtitle">Kami menawarkan berbagai program pembiayaan yang dirancang khusus untuk kebutuhan UMKM di desa dengan suku bunga rendah dan proses yang mudah.</p>
            <div class="feature-container">
                <div class="feature-card">
                    <div class="feature-icon">💰</div>
                    <h3>Pinjaman Modal Usaha</h3>
                    <p>Pinjaman untuk modal kerja, pengembangan usaha, atau memulai usaha baru dengan suku bunga rendah mulai dari 3% per tahun dan tenor hingga 36 bulan.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🛠️</div>
                    <h3>Pembiayaan Alat Produksi</h3>
                    <p>Dana khusus untuk pembelian peralatan, mesin, atau teknologi yang dibutuhkan untuk meningkatkan kapasitas dan kualitas produksi usaha Anda.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🌱</div>
                    <h3>Dana Pertanian & Peternakan</h3>
                    <p>Program pembiayaan khusus untuk petani, peternak, dan usaha pengolahan hasil pertanian dengan jadwal pembayaran yang disesuaikan dengan masa panen.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Loan Process -->
    <section class="loan-process section-white" id="proses">
        <div class