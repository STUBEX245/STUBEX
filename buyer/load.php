
						<div class="card-body msg_card_body">
						<?php if($from_id != $_SESSION['email']) {?>
							<div class="d-flex justify-content-start mb-4">
								<div class="img_cont_msg">
									<img src="../images/logo/profile.png" class="rounded-circle user_img_msg">
								</div>
								<div class="msg_cotainer">
								  <?php echo $message; ?>
									<!-- <span class="msg_time">8:40 AM, Today</span> -->
								</div>
							</div>
							<?php }else { ?>
							<div class="d-flex justify-content-end mb-4">
								<div class="msg_cotainer_send">
										<?php echo $message; ?>
									<!-- <span class="msg_time_send">8:40 AM, Today</span> -->
								</div>
								<div class="img_cont_msg">
							<img src="../images/logo/profile-green.png" class="rounded-circle user_img_msg">
								</div>
							</div>
							<?php
								}
							?>
			
									</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

