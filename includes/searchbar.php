<style>

* {
  box-sizing: border-box;
}
.example {
  display: flex;
}

/* Style the search field */
form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: none;
  display:inline-block;
  float: left;
  width: 90%;
  background: #f1f1f1;
}

/* Style the submit button */
form.example button {
  float: left;
  width: 10%;
  padding: 10px;
  display:inline-block;
  background: #033B4A;
  color: white;
  font-size: 17px;
  border: none;
  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

form.example button:hover {
  background: #2DA95C;
}

/* Clear floats */
form.example::after {
  content: "";
  clear: both;
  display: table;
}
</style>
<!-- Load icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- The form -->
<form class="example" action="search.php" method="post">
<input type="text" placeholder="Search.." name="keyword">
<button type="submit" ><i class="fa fa-search"></i></button>
</form>
