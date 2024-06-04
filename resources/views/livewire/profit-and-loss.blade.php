<div class="midde_cont">
   <div class="container-fluid">
       <div class="row column_title">
           <div class="col-md-12">
               <div class="page_title">
                   <h2>Dashboard</h2>
               </div>
           </div>
       </div>
       <div class="row">
           <div class="col-md-3">
               <div class="card">
                   <div class="card-body">
                       <h5 class="card-title">Day Summary</h5>
                       <p class="card-text">Total Sale: {{ $all_sales }}</p>
                       <p class="card-text">Total Cost: {{ $all_cost }}</p>
                       <p class="card-text">Total Profit: {{ $all_profit }}</p>
                   </div>
               </div>
           </div>
       </div>

       {{ $paginatedProducts->links() }}
   </div>
</div>
