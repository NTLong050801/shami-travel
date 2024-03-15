<!--Faq Section Start-->
<?php if ( $faqs ): ?>
<div class="te-faq__sec pb_60 mb_55 border-bottom">
    <h3><?php echo !empty($meta['faq-section-title']) ? esc_html($meta['faq-section-title']) : ''; ?></h3>
    <p><?php esc_html_e( "Let’s clarify your confusions. Here are some of the Frequently Asked Questions which most of our client asks.", 'travic' ); ?></p>
    
    <?php 
    $tf_enquiry_section_status = !empty($meta['t-enquiry-section']) ? $meta['t-enquiry-section'] : "";
    $tf_enquiry_section_icon = !empty($meta['t-enquiry-option-icon']) ? esc_html($meta['t-enquiry-option-icon']) : '';
    $tf_enquiry_section_title = !empty($meta['t-enquiry-option-title']) ? esc_html($meta['t-enquiry-option-title']) : '';
    $tf_enquiry_section_des = !empty($meta['t-enquiry-option-content']) ? esc_html($meta['t-enquiry-option-content']) : '';
    $enquery_button_text = !empty($meta['t-enquiry-option-btn']) ? esc_html($meta['t-enquiry-option-btn']) : '';

    if(!empty($tf_enquiry_section_status) && ( !empty($tf_enquiry_section_icon) || !empty($tf_enquiry_section_title) || !empty($enquery_button_text))){
    ?>
    
    <div class="tf-ask-question mt_40">
        <div class="default-enquiry-title-section">
            <?php
            if(!empty($tf_enquiry_section_icon)) {
                ?>
                <i class="<?php echo esc_attr( $tf_enquiry_section_icon ); ?>" aria-hidden="true"></i>
                <?php
            }
            if(!empty($tf_enquiry_section_title)) {
                ?>
                <h3><?php echo wp_kses( $tf_enquiry_section_title, true ); ?></h3>
                <?php
            }
            ?>
        </div>
        <?php
        if(!empty($tf_enquiry_section_des)) {
            ?>
                <p><?php echo wp_kses( $tf_enquiry_section_des, true ); ?></p>
            <?php
            }
            ?>
        <?php 
        if(!empty($enquery_button_text)) {
            ?>
            <div class="btn-box mt_10"><a href="#" id="tf-ask-question-trigger" class="theme-btn btn-one">
                <span><?php echo wp_kses( $enquery_button_text, true ); ?></span></a>
            </div>
            <?php
        }
        ?>
    </div>
    <?php } ?>
    
    <div class="faq-section mt_50">
    
    	<ul class="accordion-box te-detail__accordian">
            <?php foreach ( $faqs as $key => $faq ): ?>
            <li class="accordion block <?php if( $key == 1 ) echo 'active-block'; ?>">
                <div class="acc-btn <?php if( $key == 1 ) echo 'active'; ?>">
                    <div class="icon-box"></div>
                    <h5><?php echo esc_html( $faq['title'] ); ?></h5>
                </div>
                <div class="acc-content <?php if( $key == 1 ) echo 'current'; ?>">
                    <div class="text">
                        <p><?php echo wp_kses( $faq['desc'], true ); ?></p>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    
    </div>
</div>
<?php endif; ?>
<!--Faq Section End-->