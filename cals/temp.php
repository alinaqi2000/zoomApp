    <h4>Temperature Calculator</h4>
    <form class="col-md-6 col-xs-12" method="post">
        <div class="form-group">
            <input type="text" placeholder="Enter Value Here" class="form-control" name="value">
        </div>
        <div class="form-group">
            <select name="type" class="form-control">
                <option value="0" disabled selected>Select Type</option>
                <option value="f2c">Fahrenheit To Celcius</option>
                <option value="c2f">Celcius To Fahrenheit</option>
            </select>
        </div>
        <div class="form-group">
            <button name="tempBtn" type="submit" class="btn w-100 <?= $themeMode == 'light' ? 'btn-warning' : 'btn-outline-warning'; ?>">Calculate Temperature</button>
        </div>
    </form>