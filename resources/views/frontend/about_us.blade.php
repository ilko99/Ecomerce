@extends('frontend.master_dashboard')
@section('main')
@section('title')
   About us
@endsection
<div class="container">
    <div class="about-us-section">
        <h1>About Us</h1>
        <p>Welcome to our website! We are dedicated to providing high-quality products and excellent customer service.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis malesuada leo eget leo faucibus, nec volutpat velit sagittis. Curabitur rutrum, magna a gravida ullamcorper, purus lacus consectetur odio, a hendrerit dolor libero eu odio. Quisque iaculis pellentesque finibus.</p>
        <p>Phasellus pulvinar aliquet magna ut luctus. Donec vel ligula sit amet justo varius lobortis. Sed vel iaculis est, id eleifend justo. Integer eget magna pellentesque, interdum turpis a, volutpat velit. Praesent non finibus turpis. Duis vel odio nisi. Vivamus condimentum, lorem a finibus eleifend, sem mi aliquet elit, et ultrices erat turpis at est. Quisque lobortis mi nec sem rhoncus, at pellentesque libero dapibus.</p>
    </div>
</div>

<style>
    .about-us-section {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
        background-color: #d3d3d3;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .about-us-section h1 {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .about-us-section p {
        line-height: 1.6;
        margin-bottom: 20px;
    }
</style>
@endsection