    <h4>Dmas Calculator</h4>
    <form class="col-md-6 col-xs-12" method="post">
        <div class="form-group">
            <input type="text" name="value1" placeholder="First Value" class="form-control" id="Value1">
        </div>
        <div class="form-group">
            <input type="text" name="value2" placeholder="Second Value" class="form-control" id="Value2">
        </div>
        <div class="form-group">
            <input type="submit" name="dmas_btn" value="Dmas Button" class="btn w-100 <?= $themeMode == 'light' ? 'btn-success' : 'btn-outline-success'; ?>">
        </div>
    </form>