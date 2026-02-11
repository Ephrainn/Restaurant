<?php
include 'includes/header.php';
require_once 'includes/db_connect.php';

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_table'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $guests = (int)$_POST['guests'];
    $requests = mysqli_real_escape_string($conn, $_POST['requests']);

    $sql = "INSERT INTO reservations (customer_name, email, phone, reservation_date, reservation_time, guest_count, special_requests) 
            VALUES ('$name', '$email', '$phone', '$date', '$time', $guests, '$requests')";

    if (mysqli_query($conn, $sql)) {
        $message = "Your table has been booked successfully! We'll contact you shortly to confirm.";
        $message_type = "success";
    }
    else {
        $message = "Something went wrong. Please try again or call us.";
        $message_type = "error";
    }
}
?>

<section class="page-header" style="background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.6)), url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; padding: 6rem 0; color: white; text-align: center;">
    <div class="container">
        <h1 style="font-size: 3rem; margin-bottom: 1rem;">Book a Table</h1>
        <p style="font-size: 1.2rem; opacity: 0.9;">Secure your spot at Bite Hive for an unforgettable dining experience.</p>
    </div>
</section>

<section style="padding: 5rem 0; background: var(--color-bg);">
    <div class="container">
        <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start;">
            <!-- Reservation Form -->
            <div class="card reservation-card" style="padding: 2.5rem;">
                <?php if ($message): ?>
                    <div style="padding: 1rem; margin-bottom: 2rem; border-radius: 8px; background: <?php echo $message_type == 'success' ? '#e8f5e9' : '#ffebee'; ?>; color: <?php echo $message_type == 'success' ? '#2e7d32' : '#c62828'; ?>; border-left: 5px solid <?php echo $message_type == 'success' ? '#4caf50' : '#f44336'; ?>;">
                        <i class="fas <?php echo $message_type == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>" style="margin-right: 0.5rem;"></i>
                        <?php echo $message; ?>
                    </div>
                <?php
endif; ?>

                <form action="reservations.php" method="POST">
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Full Name</label>
                        <input type="text" name="name" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#ddd'">
                    </div>
                    
                    <div class="grid" style="grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Email</label>
                            <input type="email" name="email" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#ddd'">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Phone</label>
                            <input type="tel" name="phone" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#ddd'">
                        </div>
                    </div>

                    <div class="grid" style="grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Date</label>
                            <input type="date" name="date" required min="<?php echo date('Y-m-d'); ?>" style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#ddd'">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Time</label>
                            <input type="time" name="time" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#ddd'">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Guests</label>
                            <select name="guests" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#ddd'">
                                <option value="1">1 Person</option>
                                <option value="2">2 People</option>
                                <option value="3">3 People</option>
                                <option value="4">4 People</option>
                                <option value="5">5 People</option>
                                <option value="6">6+ People</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: 2rem;">
                        <label style="display: block; margin-bottom: 0.5rem; font-weight: 600;">Special Requests (Optional)</label>
                        <textarea name="requests" rows="3" style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 8px; outline: none; transition: border-color 0.3s;" onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='#ddd'"></textarea>
                    </div>

                    <button type="submit" name="book_table" class="btn btn-primary" style="width: 100%; padding: 1rem; font-size: 1.1rem; font-weight: 600;">Confirm Booking</button>
                </form>
            </div>

            <!-- Info Column -->
            <div style="padding-top: 2rem;">
                <h2 style="font-size: 2.2rem; margin-bottom: 1.5rem;">Why book with us?</h2>
                <div style="margin-bottom: 2rem;">
                    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
                        <div style="min-width: 50px; height: 50px; background: #fff3e0; color: #ef6c00; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h4 style="margin-bottom: 0.3rem;">Save Time</h4>
                            <p style="color: var(--color-text-light);">Skip the queue and have your table ready the moment you arrive.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
                        <div style="min-width: 50px; height: 50px; background: #e3f2fd; color: #1976d2; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div>
                            <h4 style="margin-bottom: 0.3rem;">Best Seats</h4>
                            <p style="color: var(--color-text-light);">Get the best views and most comfortable spots in the house.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 1rem;">
                        <div style="min-width: 50px; height: 50px; background: #f3e5f5; color: #7b1fa2; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem;">
                            <i class="fas fa-glass-cheers"></i>
                        </div>
                        <div>
                            <h4 style="margin-bottom: 0.3rem;">Special Occasions</h4>
                            <p style="color: var(--color-text-light);">Let us know if it's a birthday or anniversary, and we'll make it special!</p>
                        </div>
                    </div>
                </div>

                <div style="background: white; padding: 2rem; border-radius: var(--border-radius); box-shadow: var(--box-shadow);">
                    <h4 style="margin-bottom: 1rem;">Need help with your booking?</h4>
                    <p style="margin-bottom: 0.5rem;"><i class="fas fa-phone-alt" style="margin-right: 0.5rem; color: var(--color-primary);"></i> 055 038 4768</p>
                    <p><i class="fas fa-envelope" style="margin-right: 0.5rem; color: var(--color-primary);"></i> reservations@bitehive.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
