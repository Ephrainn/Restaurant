<?php include 'includes/header.php'; ?>

<!-- About Hero --> 
<section style="background:  linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1552566626-52f8b828add9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; background-attachment: fixed; height: 50vh; display: flex; align-items: center; color: white;">
    <div class="container text-center">
        <h1 style="font-size: 3.5rem; text-shadow: 2px 4px 8px rgba(0,0,0,0.3);">Our Journey</h1>
        <p style="font-size: 1.3rem; opacity: 0.95; text-shadow: 1px 2px 4px rgba(0,0,0,0.3);">Bringing authentic flavors to your table since 2024</p>
    </div>
</section>

<div class="container" style="padding: 5rem 1rem;">
    <!-- Story Section -->
    <div style="max-width: 900px; margin: 0 auto 5rem;">
        <h2 class="text-center mb-2" style="font-size: 2.5rem;">Our Story</h2>
        
        <p class="mb-1" style="font-size: 1.15rem; color: var(--color-text-light); line-height: 1.8;">
            Started in 2024, Bite Hive was born from a simple passion: making authentic, high-quality food accessible to everyone. We believe that good food shouldn't just fill your stomach—it should warm your heart.
        </p>
        
        <p class="mb-2" style="font-size: 1.15rem; color: var(--color-text-light); line-height: 1.8;">
            Our chefs source the freshest ingredients daily from local markets to ensure every dish bursts with natural flavor. Whether it's our signature Jollof Rice or our handmade burgers, we don't cut corners.
        </p>
        
        <!-- Timeline -->
        <div style="margin-top: 4rem; position: relative; padding-left: 3rem;">
            <div style="position: absolute; left: 1rem; top: 0; bottom: 0; width: 3px; background: linear-gradient(to bottom, var(--color-primary), var(--color-secondary));"></div>
            
            <div class="timeline-item" style="margin-bottom: 3rem; position: relative;">
                <div style="position: absolute; left: -2.5rem; width: 30px; height: 30px; border-radius: 50%; background: var(--color-primary); border: 4px solid white; box-shadow: 0 0 0 2px var(--color-primary);"></div>
                <div style="background: white; padding: 1.5rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow);">
                    <h4 style="color: var(--color-primary); font-size: 1.3rem; margin-bottom: 0.5rem;">2024 - The Beginning</h4>
                    <p style="color: var(--color-text-light); line-height: 1.7;">Bite Hive opened its doors with a simple menu and big dreams. Our first customer still orders from us weekly!</p>
                </div>
            </div>
            
            <div class="timeline-item" style="margin-bottom: 3rem; position: relative;">
                <div style="position: absolute; left: -2.5rem; width: 30px; height: 30px; border-radius: 50%; background: var(--color-secondary); border: 4px solid white; box-shadow: 0 0 0 2px var(--color-secondary);"></div>
                <div style="background: white; padding: 1.5rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow);">
                    <h4 style="color: var(--color-secondary); font-size: 1.3rem; margin-bottom: 0.5rem;">Mid-2024 - Growing Family</h4>
                    <p style="color: var(--color-text-light); line-height: 1.7;">We expanded our team and menu, introducing beloved classics like our Smash Burgers and Green Power Bowls.</p>
                </div>
            </div>
            
            <div class="timeline-item" style="position: relative;">
                <div style="position: absolute; left: -2.5rem; width: 30px; height: 30px; border-radius: 50%; background: #4ecdc4; border: 4px solid white; box-shadow: 0 0 0 2px #4ecdc4;"></div>
                <div style="background: white; padding: 1.5rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow);">
                    <h4 style="color: #4ecdc4; font-size: 1.3rem; margin-bottom: 0.5rem;">Today - Serving Thousands</h4>
                    <p style="color: var(--color-text-light); line-height: 1.7;">With over 5,000 happy customers and 500+ daily orders, we're just getting started on our journey to bring joy through food.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Our Promise -->
    <h2 class="text-center mb-2" style="font-size: 2.5rem;">Our Promise to You</h2>
    <ul style="list-style: none; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 5rem;">
        <li style="background: white; padding: 2.5rem 2rem; border-radius: var(--border-radius); text-align: center; box-shadow: var(--box-shadow); transition: var(--transition); border-top: 4px solid var(--color-primary);" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.12)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
            <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #e53935 0%, #b71c1c 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-leaf" style="font-size: 2.5rem; color: white;"></i>
            </div>
            <h4 style="margin-bottom: 0.75rem; font-size: 1.3rem;">Fresh Ingredients</h4>
            <p style="color: var(--color-text-light); line-height: 1.6;">Sourced daily from trusted local suppliers</p>
        </li>
        <li style="background: white; padding: 2.5rem 2rem; border-radius: var(--border-radius); text-align: center; box-shadow: var(--box-shadow); transition: var(--transition); border-top: 4px solid #ff6b6b;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.12)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
            <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #ff6b6b 0%, #d32f2f 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-fire" style="font-size: 2.5rem; color: white;"></i>
            </div>
            <h4 style="margin-bottom: 0.75rem; font-size: 1.3rem;">Served Hot</h4>
            <p style="color: var(--color-text-light); line-height: 1.6;">Fast delivery ensures your meal arrives piping hot</p>
        </li>
        <li style="background: white; padding: 2.5rem 2rem; border-radius: var(--border-radius); text-align: center; box-shadow: var(--box-shadow); transition: var(--transition); border-top: 4px solid #4ecdc4;" onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='0 10px 30px rgba(0,0,0,0.12)'" onmouseout="this.style.transform=''; this.style.boxShadow=''">
            <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-heart" style="font-size: 2.5rem; color: white;"></i>
            </div>
            <h4 style="margin-bottom: 0.75rem; font-size: 1.3rem;">Made with Love</h4>
            <p style="color: var(--color-text-light); line-height: 1.6;">Every dish is prepared with care and passion</p>
        </li>
    </ul>
    
    <!-- Team Section -->
    <h2 class="text-center mb-1" style="font-size: 2.5rem;">Meet Our Chefs</h2>
    <p class="text-center" style="max-width: 600px; margin: 0 auto 3rem; color: var(--color-text-light); font-size: 1.1rem;">
        The talented people behind your favorite dishes
    </p>
    
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-bottom: 5rem;">
        <!-- Chef 1 -->
        <div class="card" style="text-align: center;">
            <div style="position: relative; overflow: hidden; height: 300px;">
                <img src="https://images.unsplash.com/photo-1577219491135-ce391730fb2c?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Chef" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); padding: 2rem 1rem 1rem; color: white;">
                    <h4 style="font-size: 1.3rem; margin-bottom: 0.25rem;">Chef Adebayo</h4>
                    <p style="font-size: 0.9rem; opacity: 0.9;">Head Chef</p>
                </div>
            </div>
            <div style="padding: 1.5rem;">
                <p style="color: var(--color-text-light); margin-bottom: 1rem; line-height: 1.6;">15+ years creating authentic African cuisine with a modern twist.</p>
                <div style="display: flex; justify-content: center; gap: 1rem;">
                    <a href="#" style="color: var(--color-primary); font-size: 1.2rem;"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: var(--color-primary); font-size: 1.2rem;"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="color: var(--color-primary); font-size: 1.2rem;"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Chef 2 -->
        <div class="card" style="text-align: center;">
            <div style="position: relative; overflow: hidden; height: 300px;">
                <img src="https://images.unsplash.com/photo-1583394293214-28ded15ee548?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Chef" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); padding: 2rem 1rem 1rem; color: white;">
                    <h4 style="font-size: 1.3rem; margin-bottom: 0.25rem;">Chef Chioma</h4>
                    <p style="font-size: 0.9rem; opacity: 0.9;">Pastry Chef</p>
                </div>
            </div>
            <div style="padding: 1.5rem;">
                <p style="color: var(--color-text-light); margin-bottom: 1rem; line-height: 1.6;">Award-winning pastry chef specializing in fusion desserts.</p>
                <div style="display: flex; justify-content: center; gap: 1rem;">
                    <a href="#" style="color: var(--color-primary); font-size: 1.2rem;"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: var(--color-primary); font-size: 1.2rem;"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="color: var(--color-primary); font-size: 1.2rem;"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Chef 3 -->
        <div class="card" style="text-align: center;">
            <div style="position: relative; overflow: hidden; height: 300px;">
                <img src="https://images.unsplash.com/photo-1559339352-11d035aa65de?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Chef" style="width: 100%; height: 100%; object-fit: cover;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); padding: 2rem 1rem 1rem; color: white;">
                    <h4 style="font-size: 1.3rem; margin-bottom: 0.25rem;">Chef Emmanuel</h4>
                    <p style="font-size: 0.9rem; opacity: 0.9;">Grill Master</p>
                </div>
            </div>
            <div style="padding: 1.5rem;">
                <p style="color: var--(--color-text-light); margin-bottom: 1rem; line-height: 1.6;">Expert in grilling and BBQ with international culinary training.</p>
                <div style="display: flex; justify-content: center; gap: 1rem;">
                    <a href="#" style="color: var(--color-primary); font-size: 1.2rem;"><i class="fab fa-facebook"></i></a>
                    <a href="#" style="color: var(--color-primary); font-size: 1.2rem;"><i class="fab fa-instagram"></i></a>
                    <a href="#" style="color: var(--color-primary); font-size: 1.2rem;"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Image Gallery -->
    <h2 class="text-center mb-2" style="font-size: 2.5rem;">Our Restaurant</h2>
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
        <div style="position: relative; overflow: hidden; border-radius: var(--border-radius); height: 250px; cursor: pointer;" onclick="openGallery(0)">
            <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Restaurant" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
            <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                <i class="fas fa-search-plus" style="color: white; font-size: 2rem;"></i>
            </div>
        </div>
        <div style="position: relative; overflow: hidden; border-radius: var(--border-radius); height: 250px; cursor: pointer;" onclick="openGallery(1)">
            <img src="https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Dining" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
            <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                <i class="fas fa-search-plus" style="color: white; font-size: 2rem;"></i>
            </div>
        </div>
        <div style="position: relative; overflow: hidden; border-radius: var(--border-radius); height: 250px; cursor: pointer;" onclick="openGallery(2)">
            <img src="https://images.unsplash.com/photo-1571997478779-2adcbbe9ab2f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Kitchen" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
            <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                <i class="fas fa-search-plus" style="color: white; font-size: 2rem;"></i>
            </div>
        </div>
        <div style="position: relative; overflow: hidden; border-radius: var(--border-radius); height: 250px; cursor: pointer;" onclick="openGallery(3)">
            <img src="https://images.unsplash.com/photo-1466220549276-aef9ce186540?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Food" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
            <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0'">
                <i class="fas fa-search-plus" style="color: white; font-size: 2rem;"></i>
            </div>
        </div>
    </div>
</div>

<script>
function openGallery(index) {
    // Simple lightbox - could be enhanced with a library
    alert('Gallery lightbox feature - Image ' + (index + 1));
}
</script>

<?php include 'includes/footer.php'; ?>
