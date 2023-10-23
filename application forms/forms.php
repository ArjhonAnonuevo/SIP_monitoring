<!DOCTYPE html>
  <html>
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <link rel="stylesheet" href="style1.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <style>
        #page2 form {
          max-width: 800px;
        }
        #page2 input{
          width: auto !important;
        }
        
      </style>
    </head>
    <body>
      <div class="top-bar">
        <img src="sec.png" alt="test">
        <h1>Sec Internship Program</h1>
      </div>
      <div class="form-page" id="page1">
        <div class="card">
          <p>Dear Applicant,</p>
          <p>Greetings from the Securities and Exchange Commission!</p>
          <p>We are pleased to know that you are considering applying to the SEC Internship Program. The SEC Internship Program is a unique learning opportunity that brings together highly qualified and motivated students with diverse backgrounds into the Securities and Exchange Commission to gain direct practical experience designed to transform them into prospective professionals capable of applying theoretical knowledge in the workplace. At the same time, the internship program ensures, where possible, optimal use of the student-intern's aptitude with a view to contributing to the improved management of the workload of the SEC.</p>
          <p>The SEC evaluates applications based on: eligibility requirements, relevance of academic study, and the level of interest and motivation to contribute to the work of the agency. The SEC also considers institutional representation and gender in the overall intern selection process.</p>
          <p>Only shortlisted candidates will be contacted.</p>
          <p>Thank you and good luck!</p>
          <button class="next-page" data-next="page2" type="button"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
        </div>
        <div id="myModal" class="modal">
          <div class="modal-content">
            <div>
              <h2>Terms and Privacy</h2>
              <p>The Securities and Exchange Commission (SEC) is committed to protecting and respecting the confidentiality of any and all information that will be provided in this online Application Portal. This survey, including any and all data gathered and/or files transmitted, is strictly confidential and intended solely for the official use of the SEC Internship Program Team.</p>
              <p>By filling out this form and providing us with your personal and other essential details, you are freely giving your informed consent to our capture, recording, processing, and use of personal information that we will gather from you. Rest assured that we will safeguard your sensitive personal information, uphold your privacy, and ensure at all times the confidentiality of such that comes to its knowledge and possession in accordance with the Data Privacy Act of 2012.</p>
              <button id="accept">Accept</button>
            </div>
          </div>
        </div>
      </div>
      </div>

      <div class="form-page" id="page2">
        <div class="d-flex justify-content-center">
          <form action="submit.php" method="POST"  class="card d-flex flex-row justify-content-between flex-wrap gap-2" enctype="multipart/form-data"style="padding:3rem 5rem; padding-left: 3rem;">
            <h1 style="width: 100%;">Personal Details</h1>
            <div class="name-container d-flex" style="width: 100%;"> 
              <span class="input-group">
                <label for="given_name">Given Name</label>
                <input type="text" name="given_name" id="given_name" placeholder="Your answer" required>
              </span>
              <span class="input-group">
                <label for="middle_name">Middle Name</label>
                <input type="text" name="middle_name" id="middle_name" placeholder="Your answer">
              </span>
              <span class="input-group">
                <label for="family_name">Family Name</label>
                <input type="text" name="family_name" id="family_name" placeholder="Your answer">
              </span>
            </div>
            <span class="d-flex flex-column" style="width: 49%;">
            <label for="address">Complete Home Address with Zip Code</label>
            <input type="text" name="address" id="address" placeholder="Your answer" required style="width:100%;">
            </span>
            <span class="d-flex flex-column" style="width: 49%;">
            <label for="place_birth">Place of Birth</label>
            <input type="text" name="place_birth" id="place_birth" placeholder="Your answer" required style="width:100%;">
            </span>
            <span class="d-flex flex-column" style="width: 49%;">
            <label for="birthday">Date of Birth</label>
            <input type="date" name="birthday" id="birthday" required style="width:100%;">
            </span>
            <span class="d-flex flex-column" style="width: 49%;">
            <label for="age">Age</label>
            <input type="text" name="age" id="age" placeholder="Your answer" required style="width:100%;">
            </span>
            <span class="d-flex flex-column" style="width: 49%;">
            <label for="gender">Sex</label>
            <input type="text" name="gender" id="gender" placeholder="Your answer" required style="width:100%;">
            </span>
           <span class="d-flex flex-column" style="width: 49%;">
           <label for="contact">Contact Number (Personal Mobile)</label>
            <input type="text" name="contact" id="contact" placeholder="Your answer" required style="width:100%;">
           </span>
            <span class="d-flex flex-column" style="width: 49%;">
            <label for="landline">Contact Number (Landline)</label>
            <input type="text" name="landline" id="landline" placeholder="Your answer" style="width:100%;">
            </span>
            <span class="d-flex flex-column" style="width: 49%;">
            <label for="primary_email">Primary Email Address</label>
            <input type="text" name="primary_email" id="primary_email" placeholder="Your answer" required style="width:100%;">
            </span>
            <span class="d-flex flex-column" style="width: 49%;">
            <label for="secondary_email">Secondary Email Address</label>
            <input type="text" name="secondary_email" id="secondary_email" placeholder="Your answer" required style="width:100%;">
            </span>
            <span class="d-flex flex-grow-1 justify-content-between" style="margin-top: 3rem; width: 100%;">
              <button class="prev-page" data-prev="page1" type="button"><i class="fa fa-angle-double-left " aria-hidden="true"></i></button>
              <button class="next-page" data-next="page3" type="button"><i class="fa fa-angle-double-right" aria-hidden="true"></i></button>
            </span>  
        </div>
      </div>

      <div class="form-page" id="page3" >
        <div class="d-flex justify-content-center"> 
          <div class="card align-items-stretch" style="padding:3rem 5rem;">
            <h1 style="margin-bottom: 1rem">File Uploads</h1>
            <label for="school_id">Upload your School ID</label>
            <input type="file" name="school_id" id="school_id" required style="width:100%;"><br>
            <label for="regi">Upload your Certificate of Registration</label>
            <input type="file" name="regi" id="regi" required style="width:100%;"><br>
            <label for="schedule">Upload your Schedule</label>
            <input type="file" name="schedule" id="schedule" require style="width:100%;"><br>
            <label for="form1">SIP Form 101 – Internship Application Form</label>
            <input type="file" name="form1" id="form1" required style="width:100%;"><br>
            <label for="form2">SIP Form 102 – Essay Questionnaire</label>
            <input type="file" name="form2" id="form2" required style="width:100%;"><br>
            <label for="form3">SIP Form 103 – Essay Questionnaire</label>
            <input type="file" name="form3" id="form3" required style="width:100%;"><br>
            <label for="form4">SIP Form 104 – Personal Data Sheet (CSC Form No. 212, Rev 2017)</label>
            <input type="file" name="form4" id="form4" required style="width:100%;">
            <span class="d-flex flex-grow-1 align-self-stretch justify-content-between" style="margin-top: 1  rem">
              <button class="prev-page" data-prev="page2" type="button"><i class="fa fa-angle-double-left" aria-hidden="true"></i> </button>
              <button class="btn btn-success" type="submit" value="<?php echo $_SESSION['form_token']; ?>">Submit</button>
            </span> 
          </div>
        </div>
      </div>
      </form>
      <script src="app.js"></script>
      <?php
    include "createtable.php";
    ?>
    </body>
  </html>