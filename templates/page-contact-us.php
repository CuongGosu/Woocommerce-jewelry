<?php
//Template name: Contact us
get_header(); ?>

<?php theBreadcrumb() ?>

	<div class="wrapperDiv page-contact-us page-content">
		<div class="contact-inner">
			<div class="contact-map">
				<?php theOption('ban_do_cong_ty') ?>
				</div>
				<h1 class="section-title my-4">Liên hệ</h1>
			<div class="form-wrapper">
				<div class="form-information">
					<h2> <?php theOption('ten_cong_ty')?></h2>
					<p>
					Liên hệ với chúng tôi qua điện thoại hoặc email để nhận được sự trợ giúp từ đội ngũ có trình độ của chúng tôi.
					</p>
					<div class="info-detail">
						<span class="icon">
							<ion-icon name="location-outline"></ion-icon>
						</span>
						<span class="text">
							<?php theOption('dia_chi')?>
						</span>
					</div>
					<div class="info-detail">
						<span class="icon">
						<ion-icon name="phone-portrait-outline"></ion-icon>
						</span>
						<span class="text">
							<?php theOption('dien_thoai')?>
						</span>
					</div>
					<div class="info-detail">
						<span class="icon">
						<ion-icon name="phone-portrait-outline"></ion-icon>
						</span>
						<span class="text">
							<?php theOption('dien_thoai_02')?>
						</span>
					</div>
					<div class="info-detail">
						<span class="icon">
						<ion-icon name="mail-outline"></ion-icon>
						</span>
						<span class="text">
							<?php theOption('email')?>
						</span>
					</div>
				</div>
				<form action="/wp-admin/admin-ajax.php" id="contact_form" class="form-contact">
					<h2>Để lại lời nhắn cho chúng tôi</h2>
					<div class="row">
					<div class="col-md-6">
							<div class="form-group">
									<input type="text" placeholder="Tên" class="form-control" name="name" required>
							</div>
					</div>
					<div class="col-md-6">
							<div class="form-group">
									<input type="email" placeholder="Email" class="form-control" name="email" required>
							</div>
					</div>
			</div>
			<div class="row">
					<div class="col-md-6">
							<div class="form-group">
									<input type="text" placeholder="Điện thoại" class="form-control" name="phone_number" required>
							</div>
					</div>
					<div class="col-md-6">
							<div class="form-group">
									<input type="text" placeholder="Chủ đề" class="form-control" name="subject" required>
							</div>
					</div>
			</div>
			<div class="form-group">
					<textarea placeholder="Nội dung" name="message" class="form-control" rows="3" required style="resize: none;"></textarea>
			</div>
			<div class="verify text-center">
					<div class="read-more">
							<?php wp_nonce_field('send_contact_form', '_token') ?>
							<button type="submit" class="btn-contact">Gửi <i class="fa fa-send"></i></button>
					</div>
			</div>

    </form>


			</div>
		</div>
	</div>

<?php get_footer() ?>