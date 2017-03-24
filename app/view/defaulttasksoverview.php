<div id="case-overview-holder">

    <header>Standaard taken Overzicht</header>
    <hr>
    <div class="case-overzicht-buttons">
        <button class="custom-file-upload">Aanmaken</button>
        <button class="custom-file-upload">Archief</button>
    </div>
    <div class="case-overvieuw-table">
        <table id="myTable" class="table table-striped">
            <thead>
            <tr>
                <th>Onderwerp</th>
                <th>Beschrijving</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <a href="#">Taak onderwerp</a>
                </td>
                <td>
                    <a href="#">Taak beschrijving</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="#">Taak onderwerp</a>
                </td>
                <td>
                    <a href="#">Taak beschrijving</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="#">Taak onderwerp</a>
                </td>
                <td>
                    <a href="#">Taak beschrijving</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="#">Taak onderwerp</a>
                </td>
                <td>
                    <a href="#">Taak beschrijving</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="#">Taak onderwerp</a>
                </td>
                <td>
                    <a href="#">Taak beschrijving</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="#">Taak onderwerp</a>
                </td>
                <td>
                    <a href="#">Taak beschrijving</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="#">Taak onderwerp</a>
                </td>
                <td>
                    <a href="#">Taak beschrijving</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="#">Taak onderwerp</a>
                </td>
                <td>    
                    <a href="#">Taak beschrijving</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="#">Taak onderwerp</a>
                </td>
                <td>
                    <a href="#">Taak beschrijving</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="#">Taak onderwerp</a>
                </td>
                <td>
                    <a href="#">Taak beschrijving</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#myTable').dataTable({
            "order": [[0, "desc"]],
            "deferRender": true
        });

    });
</script>