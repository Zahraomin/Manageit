<template>

    <div class="modal fade" id="staticBackdrop2" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add a New Application</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addAppForm">

                    <div class="modal-body">

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" name="description">
                        </div>
                        <div class="form-group">
                            <label>Device Used</label>

                            <div class="row d-flex justify-content-left ">
                                <div class="col-md-8">

                                    <select id="deviceSelector" name="appDevice[]" multiple="multiple">
                                        @foreach($device as $row)
                                        <option >{{$row['serialNum']}}</option>
                                        @endforeach
                                    </select>

                                    <select multiple class="form-control" id="device" name="appDevice">

                                    </select>
                                </div>
                            </div>

                        </div>
                        <div style="width:250px;" class="form-group">
                            <label>Purchase Date</label>
                            <input type="date" class="form-control" name="purchase">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
        

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }

</script>

