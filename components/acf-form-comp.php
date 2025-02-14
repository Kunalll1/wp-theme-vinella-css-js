<?php 

    // Check if form was submitted successfully
    $form_submitted = isset($_GET['form_submitted']) && $_GET['form_submitted'] == 'true';

    // Display ACF form
    acf_form([
        'post_id'      => 'new_post', // Creates a new post on form submission
        'post_title'    => true,
        'form'          => true, 
        'new_post'     => [
            'post_type'   => 'form-data', // Change to 'custom_post_type' if needed
            'post_status' => 'draft',
        ],
        'field_groups' => array(41), // Replace with your actual ACF Field Group ID
        'submit_value' => 'Submit',
        // 'return'       => add_query_arg('form_submitted', 'true', get_permalink()), // Stay on the same page & show message
    ]);

    // Display Thank You message if the form was submitted
    if ($form_submitted) :
        echo '<p class="thank-you-message">Thanks for your interest, we will get back to you soon</p>';
    endif;
?>

<script>
    const title = document.querySelector("#acf-form > div.acf-fields.acf-form-fields.-top > div.acf-field.acf-field-text.acf-field--post-title.is-required > div.acf-label > label");
    title.textContent = "Full Name";
</script>