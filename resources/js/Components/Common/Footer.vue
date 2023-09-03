<script setup>

</script>

<template>
    <v-footer class="text-center d-flex flex-column" fixed >
        <div class="d-flex justify-space-between w-100">
            <div>
                Laravel v{{ $page.props.laravelVersion }} (PHP v{{ $page.props.phpVersion }})
            </div>
            <div>
                {{ new Date().getFullYear() }} - &copy;Mortgages, Loan Calculator
            </div>
            <div>
                Developed by: <a href="https://www.linkedin.com/in/shawki-alasy/" class="font-weight-bold" target="_blank">Shawki Alasy</a>
            </div>
        </div>

    </v-footer>
</template>
