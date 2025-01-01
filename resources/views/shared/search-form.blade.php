<form action="{{ route('search') }}" method="GET" class="search-container">
   <input type="text" name="query" id="searchInput" 
          class="form-control search-input"
          placeholder="Search" autocomplete="off">

   <button type="submit" class="btn btn-outline-dark btn-sm search-btn">
       <i class="fa-solid fa-magnifying-glass"></i>
   </button>
</form>
