@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/about-us.css') }}" />
@endsection

@section('content')
<div class="solar-breadcrumb">
    <button class="solar-breadcrumb-button">
     <a href="/"> <div class="solar-breadcrumb-item">Home</div></a>
    </button>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper">
        <a href='/about'><div class="solar-breadcrumb-item">About Us</div></a>
    </div>
</div>

<div class="main-section">
  <div class="banner" style="background-image: url('homepage/images/about/banner.png');">
    <h1>About Oplug Energies</h1>
    <p class="subtitle">Energy Solutions Company</p>
  </div>
  <h3 class="tagline">BRINGING<span style="color: #f7982a;"> SUSTAINABLE ENERGY SOLUTIONS </span>TO YOU</h3>
  <div class="info-section">
    <div class="info-image" style="background-image: url('homepage/images/about/about.png');"></div>
    <div class="info-card">
      <p>Oplug Energies is your trusted partner in modern energy solutions.</p>
      <p>While our online presence is currently under refinement, our commitment to excellence remains unwavering. We’re continuously building a robust identity and expanding our footprint to better serve you with innovative energy solutions.</p>
      <a href="#" class="shop-now">Shop Now</a>
    </div>
  </div>
  <div class="values">
    <div class="value-card">
      <h2>Client Focused</h2>
      <p>We place your goals and satisfaction at the heart of everything we do.</p>
    </div>
    <div class="value-card">
      <h2>Forward-Looking</h2>
      <p>Our vision is always future-oriented—striving for smarter, cleaner, and better energy.</p>
    </div>
    <div class="value-card">
      <h2>Trustworthy</h2>
      <p>Transparency, integrity, and service excellence form the backbone of our operations.</p>
    </div>
  </div>
  <div class="vision-mission">
    <div class="content">
      <div class="content-block">
        <h2>Our Story</h2>
        <p>Oplug Limited is a leading provider of innovative renewable energy solutions and high-performance machinery lubricants. We specialize in harnessing the power of sustainable energy sources and optimizing industrial operations through our cutting-edge products and expertise.</p>
      </div>
      <div class="content-block">
        <h2>Our Mission</h2>
        <p>Our mission is to drive efficiency, save energy cost, and empower businesses to thrive in a rapidly evolving world.</p>
      </div>
      <div class="content-block">
        <h2>Our Vision</h2>
        <p>To be a global leader in providing innovative quality machinery lubricants and solar power solutions, driving efficiency and promote sustainable practices globally.</p>
      </div>
    </div>
    <img src="homepage/images/about/about2.png" alt="Oplug Energies" class="vision-image">
  </div>
 
  <div class="team">
    <h2>Our Team</h2>
    <div class="team-members">
      <div class="team-member">
        <div class="member-image" style="background-image: url('homepage/images/about/ceo1.png');"></div>
        <h3>Oluwaseun Mendes</h3>
        <p>MD/CEO</p>
      </div>
      <div class="team-member">
        <div class="member-image" style="background-image: url('homepage/images/about/ceo2.png');"></div>
        <h3>Adekunle Taiwo</h3>
        <p>Operations Manager</p>
      </div>
      <div class="team-member">
        <div class="member-image" style="background-image: url('homepage/images/about/adeoye.jpg');"></div>
        <h3>Oluwatosin Adeoye</h3>
        <p>Operations Manager</p>
      </div>
      <div class="team-member">
        <div class="member-image" style="background-image: url('homepage/images/about/gbenga.png');"></div>
        <h3>Ogungbemi Gbenga</h3>
        <p>Sales Social Media Strategist</p>
      </div>
    </div>
  </div>
 
 
</div>

@endsection

@section('script')
@endsection