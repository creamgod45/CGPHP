<div class="container">
    <h1>玩家查詢</h1>
    <div class="cgcard info-card mt-5 pink">
        <div class="m-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">玩家遊戲 ID</label>
            <div class="col-sm-10">
                <div class="input-group col">
                    <input type="text" class="form-control" id="playername" autocomplete="nickname"/>
                    <button class="btn btn-success" onclick="f0('#playername', b, '#error_message');"><i
                                class="fa-solid fa-magnifying-glass"></i>&nbsp;查詢
                    </button>
                </div>
            </div>
        </div>
        <div class="m-3">
            <span id="error_message">&nbsp;</span>
        </div>
    </div>
</div>