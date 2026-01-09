<?php include 'includes/header.php'; ?>

<section class="faq-section">
  <h2 class="faq-heading">Frequently Asked Questions</h2>

  <div class="faq-container">
    <div class="faq-item">
      <button class="faq-question">What is UNNify?</button>
      <div class="faq-answer">
        <p>UNNify is a web-based buy and sell platform for students of the University of Nigeria, Nsukka. It allows students to post, browse, and buy items safely within the campus community.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Who can use UNNify?</button>
      <div class="faq-answer">
        <p>Only students of the University of Nigeria, Nsukka can register and use the platform. This helps ensure trust and safety in transactions.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">How do I post an item for sale?</button>
      <div class="faq-answer">
        <p>After signing up and logging in, go to your dashboard and click on “Post Item.” You’ll be asked to upload a photo, enter a description, set a price, and choose a category.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Is it free to use UNNify?</button>
      <div class="faq-answer">
        <p>Yes, UNNify is 100% free for all UNN students. There are no listing or transaction fees.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">How do I contact a seller?</button>
      <div class="faq-answer">
        <p>Click on any item to view full details. You’ll see the seller’s contact information (phone or email) to reach out directly.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Are transactions done on the site?</button>
      <div class="faq-answer">
        <p>No. UNNify connects buyers and sellers. All payments and item exchanges are handled offline, preferably in a safe location on campus.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Can I edit or delete my listing?</button>
      <div class="faq-answer">
        <p>Yes, from your dashboard you can manage all your listings — including editing or deleting any post you made.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">What if I notice a suspicious listing?</button>
      <div class="faq-answer">
        <p>Click the "Report Listing" button found on each item page. Our admin team will review and take action if necessary.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">What types of items are allowed?</button>
      <div class="faq-answer">
        <p>You can list items like phones, laptops, books, clothes, shoes, bags, and other personal belongings. Illegal or prohibited items are not allowed and will be removed.</p>
      </div>
    </div>

    <div class="faq-item">
      <button class="faq-question">Can I use UNNify outside the school?</button>
      <div class="faq-answer">
        <p>Currently, UNNify is designed strictly for students of UNN and works best within the campus. Plans to expand are in the works.</p>
      </div>
    </div>
  </div>
</section>
<?php include 'includes/footer.php'; ?>
<script>
  const faqs = document.querySelectorAll(".faq-question");
  faqs.forEach(btn => {
    btn.addEventListener("click", () => {
      const answer = btn.nextElementSibling;
      const isOpen = answer.style.display === "block";

      document.querySelectorAll(".faq-answer").forEach(ans => ans.style.display = "none");

      answer.style.display = isOpen ? "none" : "block";
    });
  });
</script>