<template>
    <div id="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

</template>

<script>
export default {
    name: 'LoaderComp'
}
</script>

<style scoped lang="scss">
#loader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(1, 0, 0, 0.5);
}
</style>


