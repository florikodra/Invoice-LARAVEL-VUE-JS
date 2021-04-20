<template>
    <div class="container"> 
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="btn btn-info text-light rounded-pill mr-3"><i class="fas fa-list"></i> Tutte Fatture</router-link>
                    <router-link to="/create" class="btn btn-outline-dark rounded-pill"><i class="fas fa-plus"></i> Creare Fattura</router-link>
                </div>
            </div>
        </nav>
        

        <router-view> </router-view>
        
    </div>
</template>
 
<script>
    export default {}
</script>