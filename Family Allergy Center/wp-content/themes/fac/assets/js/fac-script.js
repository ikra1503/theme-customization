// Services Box 

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".service-box").forEach(function (box) {
        box.addEventListener("mouseenter", function () {
            this.classList.add("active-card");
        });

        box.addEventListener("mouseleave", function () {
            this.classList.remove("active-card");
        });
    });
});



// Testimonial

let index = 0;
const testimonials = document.querySelectorAll('.testimonial');
const dots = document.querySelectorAll('.dot');
const wrapper = document.querySelector('.testimonial-wrapper');

function showTestimonial(n) {
    testimonials.forEach((testimonial, i) => {
        testimonial.classList.remove('active');
        dots[i].classList.remove('active');
        if (i === n) {
            testimonial.classList.add('active');
            dots[i].classList.add('active');
        }
    });
    wrapper.style.transform = `translateX(-${n * 100}%)`;
}

function nextTestimonial() {
    index = (index + 1) % testimonials.length;
    showTestimonial(index);
}

function setTestimonial(n) {
    index = n;
    showTestimonial(index);
}

setInterval(nextTestimonial, 3000);



// Mobile-Menu

function toggleMenu() {
    const navLinks = document.querySelector('.nav-links');
    const menuToggle = document.querySelector('.menu-toggle');
    navLinks.classList.toggle('active');
    menuToggle.classList.toggle('hide');
}