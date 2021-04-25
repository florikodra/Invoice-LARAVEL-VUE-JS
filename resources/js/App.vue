<template>
    <div class="container"> 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="btn btn-info text-light rounded-pill mr-3 backg-c"><i class="fas fa-list"></i> Tutte Fatture</router-link>
                    <router-link to="/create" class="btn btn-outline-dark rounded-pill"><i class="fas fa-plus"></i> Creare Fattura</router-link>
                </div>
            </div>
        </nav>
        
        

        <div class="btn-group dropup position-fixed d-none custom-menu">
        <button type="button" class="btn btn-secondary dropdown-toggle rounded-circle p-3 bg-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-list"></i> 
        </button>
        <div class="dropdown-menu">
           <router-link to="/create" class="dropdown-item"><i class="fas fa-plus"></i> Creare Fattura</router-link>
           <router-link to="/" class="dropdown-item"><i class="fas fa-list"></i> Tutte Fatture</router-link>
        </div>
        </div>

        <router-view> </router-view>
        
    </div>
</template>
 
<script>
    export default {}
</script>