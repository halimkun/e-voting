<?= $this->extend('template_admin/layout'); ?>
<?= $this->section('content'); ?>
<section class="section">
  <div class="section-header">
    <h1>
      Anggota Aktif
    </h1>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Daftar Anggota Osis</h4>
            <div class="card-header-action">
              <button type="button" class="btn btn-primary btn-sm btn-icon" data-toggle="modal" data-target="#morg">
                <i class="fa fa-pen"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div id="myDiagramDiv" style="width:100% !important; height:400px !important;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="morg" tabindex="-1" aria-labelledby="morgLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="morgLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/admin/anggota/save" method="post" id="orgform">
        <div class="modal-body">
          <div class="row">
          <?php foreach ($fields as $field) : ?>
              <div class="form-group <?= in_array($field['jabatan'], $colCondition) ? 'col-12 col-md-6' : 'col-12' ?>">
                <label for="nama" class="form-label mb-1">Nama <?= $field['jabatan'] ?></label>
                <input type="text" name="<?= str_replace(" ", "_", $field['jabatan']) ?>" id="nama" value="<?= $field['nama'] ?>" class="form-control">
              </div>
              <?php endforeach ?>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-dsms" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script_js'); ?>
<script src="https://unpkg.com/gojs/release/go-debug.js"></script>
<script>
  $(document).ready(function() {
    const myDiagram = new go.Diagram("myDiagramDiv", {
      layout: new go.TreeLayout({
        angle: 0,
        treeStyle: go.TreeLayout.StyleLastParents,
        arrangement: go.TreeLayout.ArrangementHorizontal,
        layerSpacing: 40,
        alternateAngle: 0,
        alternateLayerSpacing: 20,
        alternateAlignment: go.TreeLayout.AlignmentBus,

      }),
      initialDocumentSpot: go.Spot.Bottom,
      initialViewportSpot: go.Spot.Bottom,
      initialAutoScale: go.Diagram.Uniform,
    });

    myDiagram.nodeTemplate = new go.Node("Horizontal", {
        background: "#6777ef",
        width: 200,
        height: 80,
      })
      /**.add(new go.Picture({
            width: 100,
            height: 100,
            source: "https://picsum.photos/200",
          }))**/
      .add(new go.Panel("Vertical", {
        margin: 20,
        defaultAlignment: go.Spot.Left,
      }).add(new go.TextBlock({
        width: 150,
        wrap: go.TextBlock.WrapDesiredSize,
        font: "bold 16px sans-serif",
        stroke: "#fff",
        margin: new go.Margin(0, 0, 4, 0),
      }).bind('text', "name")).add(new go.TextBlock({
        font: "bold 12px sans-serif",
        stroke: "#fff",
        whiteSpace: "normal",
        margin: new go.Margin(0, 0, 0, 0),
      }).bind('text', "jabatan")));

    myDiagram.model = new go.TreeModel(
      JSON.parse('<?= $anggota; ?>')
    );

  });
</script>
<?= $this->endSection(); ?>