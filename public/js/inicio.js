// FAQ Accordion Functionality
document.addEventListener('DOMContentLoaded', function() {
    const faqToggles = document.querySelectorAll('.faq-toggle');

    faqToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            // Get the answer element (next sibling)
            const answer = this.nextElementSibling;

            // Close all other open answers
            faqToggles.forEach(otherToggle => {
                if (otherToggle !== this) {
                    const otherAnswer = otherToggle.nextElementSibling;
                    otherAnswer.classList.add('hidden');
                }
            });

            // Toggle current answer
            answer.classList.toggle('hidden');
        });
    });
});