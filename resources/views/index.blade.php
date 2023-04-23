@extends('layouts.core')

@section('container')
    <div class="container">
        <section id="intro">
            <div class="wrapper px-3">
                <div class="intro-left">
                    <h1>Creative Technology to Grow Your Knowledge</h1>
                    <p>
                        The modern option that makes it very easy for you to borrow books without having to waste a lot of time in the library.
                    </p>
                    <a href="/books" class="btn btn-primary intro-cta text-decoration-none">
                        Try For Free
                    </a>
                </div>
                <div class="intro-right">
                    <!-- Insert Image here -->
                    <img src="../img/home/reading.svg" alt="image" class="undraw-growth">
                </div>
            </div>
        </section>
        
        <!-- Intro Page END -->
        
        <!-- About Page Start -->
        
        <div class="about-section">
            <div class="inner-container">
                <h1 class="text-center text-uppercase">About Us</h1>
                <p class="text">
                    V-Library is a digital product created to facilitate academics in the process of borrowing library books. Continue to develop your knowledge by reading books without having to jostle in a conventional library !
                </p>
            </div>
        </div>
        
        <!-- About Page END -->
        
    </div>

    <!-- Page Banner START -->
    
    <div class="page-banner px-2">
        <h1>Book Loans Made Easy</h1>
        <h3>Experience the Modern Book Loan System</h3>
        <a href="/developers" class="text-uppercase text-decoration-none">Visit the Owner</a>
    </div>
    
    <!-- Banner END -->
    
    
@endsection
