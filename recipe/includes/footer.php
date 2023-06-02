
<footer>
  <div class="container  pt-4 pb-3 ">
    <div class="row">
      <div class="col-md-6">
        <p class="footer">&copy; 2023 My Recipe Saving Website</p>
      </div></br>
      <div class="col-md-6">
        <form class="footer-form"action="/submit-rating" method="post">
          <label for="rating">Rate this website:</label>
          <select name="rating" id="rating" required>
            <option value="">Select a rating</option>
            <option value="1">1 star</option>
            <option value="2">2 stars</option>
            <option value="3">3 stars</option>
            <option value="4">4 stars</option>
            <option value="5">5 stars</option>
          </select>
          <button type="submit" class="btn btn-sm btn-light">Submit</button>
        </form>
      </div>
    </div>
  </div>
</footer>

</body>
</html>
<?php mysqli_stmt_close($stmt); ?>