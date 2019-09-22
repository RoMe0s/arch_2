<template>
    <div class="container mt-3 mb-3">
        <actions-component></actions-component>
        <hr>
        <shapes-component></shapes-component>
        <hr>
        <history-component></history-component>
        <hr>
        <rollback-component></rollback-component>
    </div>
</template>

<script>
    import ActionsComponent from './actions-component';
    import ShapesComponent from './shapes-component';
    import HistoryComponent from './history-component';
    import RollbackComponent from './rollback-component';

    export default {
        components: {
            ActionsComponent,
            ShapesComponent,
            HistoryComponent,
            RollbackComponent
        }
    }
</script>
