const testimonials = [
    "Earning is limitless based on effort and results.",
    "I enjoy traveling while working and achieving my goals.",
    "Being recognized for my hard work keeps me motivated.",
    "My career has grown significantly with this team.",
    "Having time freedom allows me to balance work and life.",
    "Collaboration has helped me grow in all aspects of life.",
    "The mentorship here is close and personal.",
    "I have found my purpose in helping others."
];

const testimonialImages = [
    "person1.jpg",
    "person2.jpg",
    "person3.jpg",
    "person4.jpg",
    "person5.jpg",
    "person6.jpg",
    "person7.jpg",
    "person8.jpg",
];

function showTestimonial(index, title, name, icon) {
    document.getElementById("testimonial-text-title").innerText = title;
    document.getElementById("testimonial-text").innerText = testimonials[index];
    document.getElementById("testimonial-name").innerText = name;
    document.getElementById("testimonial-icon").className = `fas ${icon}`;

    // Update image dynamically
    document.getElementById("testimonial-image").src = testimonialImages[index];
}

function proceedToSection2() {
    window.parent.postMessage("goToSection2", "*");
}