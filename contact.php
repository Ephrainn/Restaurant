<?php include 'includes/header.php'; ?>

<!-- Contact Hero -->
<section style="background: linear-gradient(135deg, #e53935 0%, #b71c1c 100%); color: white; padding: 4rem 0; position: relative;">
    <div class="container text-center">
        <h1 style="font-size: 3rem; margin-bottom: 1rem;">Get in Touch</h1>
        <p style="font-size: 1.2rem; opacity: 0.95;">We'd love to hear from you! Reach out with any questions or feedback.</p>
    </div>
</section>

<div class="container" style="padding: 4rem 1rem;">
    
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem; margin-bottom: 4rem;">
        <!-- Contact Info Cards -->
        <div style="background: white; padding: 2.5rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); text-align: center; transition: var(--transition);" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
            <div style="width: 70px; height: 70px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #e53935 0%, #b71c1c 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-map-marker-alt" style="font-size: 2rem; color: white;"></i>
            </div>
            <h4 style="margin-bottom: 1rem; font-size: 1.4rem;">Address</h4>
            <p style="color: var(--color-text-light); line-height: 1.7; font-size: 1.05rem;">123 Tasty Avenue<br>Food District<br>Lagos, Nigeria</p>
        </div>
        
        <div style="background: white; padding: 2.5rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); text-align: center; transition: var(--transition);" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
            <div style="width: 70px; height: 70px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #ff6b6b 0%, #d32f2f 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-clock" style="font-size: 2rem; color: white;"></i>
            </div>
            <h4 style="margin-bottom: 1rem; font-size: 1.4rem;">Opening Hours</h4>
            <p style="color: var(--color-text-light); line-height: 1.7; font-size: 1.05rem;">Mon - Fri: 8am - 10pm<br>Sat - Sun: 10am - 11pm<br>Delivery Available All Hours</p>
        </div>
        
        <div style="background: white; padding: 2.5rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); text-align: center; transition: var(--transition);" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.15)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
            <div style="width: 70px; height: 70px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-phone" style="font-size: 2rem; color: white;"></i>
            </div>
            <h4 style="margin-bottom: 1rem; font-size: 1.4rem;">Phone & WhatsApp</h4>
            <a href="tel:0550384768" style="color: var(--color-primary); text-decoration: none; font-size: 1.3rem; font-weight: 600;">055 038 4768</a><br>
            <a href="https://wa.me/233550384768" style="display: inline-block; margin-top: 1rem; background: #25D366; color: white; padding: 0.6rem 1.3rem; border-radius: 50px; text-decoration: none; font-weight: 600;">
                <i class="fab fa-whatsapp"></i> WhatsApp Us
            </a>
        </div>
    </div>
    
    <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 3rem;">
        <!-- Contact Form -->
        <div style="background: white; padding: 3rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow);">
            <h2 style="margin-bottom: 1.5rem;">Send Us a Message</h2>
            <form id="contactForm">
                <div class="mb-1">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Name</label>
                    <input type="text" required style="width: 100%; padding: 0.9rem; border: 2px solid #eee; border-radius: 8px; transition: var(--transition);" onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(229, 57, 53, 0.1)'" onblur="this.style.borderColor='#eee'; this.style.boxShadow=''">
                </div>
                
                <div class="mb-1">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Email</label>
                    <input type="email" required style="width: 100%; padding: 0.9rem; border: 2px solid #eee; border-radius: 8px; transition: var(--transition);" onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(229, 57, 53, 0.1)'" onblur="this.style.borderColor='#eee'; this.style.boxShadow=''">
                </div>
                
                <div class="mb-1">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Subject</label>
                    <input type="text" required style="width: 100%; padding: 0.9rem; border: 2px solid #eee; border-radius: 8px; transition: var(--transition);" onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(229, 57, 53, 0.1)'" onblur="this.style.borderColor='#eee'; this.style.boxShadow=''">
                </div>
                
                <div class="mb-1">
                    <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Message</label>
                    <textarea required rows="4" style="width: 100%; padding: 0.9rem; border: 2px solid #eee; border-radius: 8px; font-family: inherit; transition: var(--transition);" onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(229, 57, 53, 0.1)'" onblur="this.style.borderColor='#eee'; this.style.boxShadow=''"></textarea>
                </div>
                
                <div id="formSuccess" style="display: none; background: #e8f5e9; color: #2e7d32; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <i class="fas fa-check-circle"></i> Message sent successfully! We'll get back to you soon.
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1.1rem;">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>
        
        <!-- Google Maps -->
        <div style="border-radius: var(--border-radius); overflow: hidden; box-shadow: var(--box-shadow); min-height: 500px;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.789301646871!2d-0.1916733!3d5.6037168!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfdf9084b2b7a773%3A0xbed14ed8650e2dd3!2sAccra%2C%20Ghana!5e0!3m2!1sen!2sgh!4v1234567890" width="100%" height="500" style="border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    
    <!-- FAQ Section -->
    <div style="margin-top: 5rem; max-width: 800px; margin-left: auto; margin-right: auto;">
        <h2 class="text-center mb-2" style="font-size: 2.5rem;">Frequently Asked Questions</h2>
        
        <div class="faq-item" style="background: white; margin-bottom: 1rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); overflow: hidden;">
            <div class="faq-question" onclick="toggleFAQ(this)" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; font-size: 1.1rem;">
                <span>How long does delivery take?</span>
                <i class="fas fa-chevron-down" style="transition: transform 0.3s;"></i>
            </div>
            <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                <div style="padding: 0 1.5rem 1.5rem; color: var(--color-text-light); line-height: 1.7;">
                    Our average delivery time is 30-45 minutes depending on your location. We'll notify you via WhatsApp with live updates on your order status.
                </div>
            </div>
        </div>
        
        <div class="faq-item" style="background: white; margin-bottom: 1rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); overflow: hidden;">
            <div class="faq-question" onclick="toggleFAQ(this)" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; font-size: 1.1rem;">
                <span>What payment methods do you accept?</span>
                <i class="fas fa-chevron-down" style="transition: transform 0.3s;"></i>
            </div>
            <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                <div style="padding: 0 1.5rem 1.5rem; color: var(--color-text-light); line-height: 1.7;">
                    We accept cash on delivery, mobile money (MTN, Vodafone, AirtelTigo), and bank transfers. Payment details will be shared when you place your order via WhatsApp.
                </div>
            </div>
        </div>
        
        <div class="faq-item" style="background: white; margin-bottom: 1rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); overflow: hidden;">
            <div class="faq-question" onclick="toggleFAQ(this)" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; font-size: 1.1rem;">
                <span>Do you cater for events?</span>
                <i class="fas fa-chevron-down" style="transition: transform 0.3s;"></i>
            </div>
            <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                <div style="padding: 0 1.5rem 1.5rem; color: var(--color-text-light); line-height: 1.7;">
                    Yes! We offer catering services for events of all sizes. Please contact us at least 48 hours in advance to discuss your requirements and get a custom quote.
                </div>
            </div>
        </div>
        
        <div class="faq-item" style="background: white; margin-bottom: 1rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow); overflow: hidden;">
            <div class="faq-question" onclick="toggleFAQ(this)" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-weight: 600; font-size: 1.1rem;">
                <span>Can I customize my order?</span>
                <i class="fas fa-chevron-down" style="transition: transform 0.3s;"></i>
            </div>
            <div class="faq-answer" style="max-height: 0; overflow: hidden; transition: max-height 0.3s ease;">
                <div style="padding: 0 1.5rem 1.5rem; color: var(--color-text-light); line-height: 1.7;">
                    Absolutely! When placing your order, you can add special instructions (e.g., extra spicy, no onions, etc.). Just mention your preferences in the order notes.
                </div>
            </div>
        </div>
    </div>
    
    <!-- Social Media -->
    <div style="text-align: center; margin-top: 5rem; padding: 3rem; background: var(--color-bg); border-radius: var(--border-radius);">
        <h3 style="margin-bottom: 1.5rem; font-size: 1.8rem;">Follow Us on Social Media</h3>
        <div style="display: flex; justify-content: center; gap: 1.5rem; flex-wrap: wrap;">
            <a href="#" style="width: 60px; height: 60px; border-radius: 50%; background: #1877F2; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; transition: var(--transition); text-decoration: none;" onmouseover="this.style.transform='translateY(-5px) scale(1.1)'" onmouseout="this.style.transform=''">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(45deg, #f09433 0%,#e6683c 25%,#dc2743 50%,#cc2366 75%,#bc1888 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; transition: var(--transition); text-decoration: none;" onmouseover="this.style.transform='translateY(-5px) scale(1.1)'" onmouseout="this.style.transform=''">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="#" style="width: 60px; height: 60px; border-radius: 50%; background: #1DA1F2; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; transition: var(--transition); text-decoration: none;" onmouseover="this.style.transform='translateY(-5px) scale(1.1)'" onmouseout="this.style.transform=''">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" style="width: 60px; height: 60px; border-radius: 50%; background: #25D366; display: flex; align-items: center; justify-content: center; color: white; font-size: 1.5rem; transition: var(--transition); text-decoration: none;" onmouseover="this.style.transform='translateY(-5px) scale(1.1)'" onmouseout="this.style.transform=''">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </div>
</div>

<script>
// Contact Form
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const successMsg = document.getElementById('formSuccess');
    successMsg.style.display = 'block';
    this.reset();
    setTimeout(() => {
        successMsg.style.display = 'none';
    }, 5000);
});

// FAQ Toggle
function toggleFAQ(element) {
    const answer = element.nextElementSibling;
    const icon = element.querySelector('i');
    const isOpen = answer.style.maxHeight && answer.style.maxHeight !== '0px';
    
    // Close all other FAQs
    document.querySelectorAll('.faq-answer').forEach(a => {
        a.style.maxHeight = '0';
    });
    document.querySelectorAll('.faq-question i').forEach(i => {
        i.style.transform = 'rotate(0deg)';
    });
    
    // Toggle current FAQ
    if (!isOpen) {
        answer.style.maxHeight = answer.scrollHeight + 'px';
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>

<?php include 'includes/footer.php'; ?>
