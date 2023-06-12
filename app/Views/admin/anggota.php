<?= $this->extend('template_admin/layout'); ?>
<?= $this->section('content'); ?>
<?= showFlasher(); ?>
<section class="section">
  <div class="section-header">
    <h1>Anggota</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item"><a href="#aaktif">Anggota Aktif</a></div>
      <div class="breadcrumb-item"><a href="#riwayata">Riwayat Anggota</a></div>
    </div>
  </div>
  <div class="section-body">
    <div class="row">
      <div class="col-12" id="aaktif">
        <div class="card">
          <div class="card-header">
            <h4>Anggota Osis Aktif</h4>
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

      <div class="col-12" id="riwayata">
        <div class="card">
          <div class="card-header">
            <h4>Riwayat Anggota Osis</h4>
            <div class="card-header-action">
              <button type="button" class="btn btn-primary btn-sm btn-icon" data-toggle="modal" data-target="#ranggota">
                <i class="fa fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
                  <th>Tahun</th>
                  <th><i class="fa fa-hashtag"></i></th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1 ?>
                <?php foreach ($riwayat as $a): ?>
                  <tr>
                    <td>
                      <?= $no++ ?>
                    </td>
                    <td>
                      <?= $a['nama'] ?>
                    </td>
                    <td>
                      <?= $a['jabatan'] ?>
                    </td>
                    <td>
                      <?= $a['tahun'] ?>
                    </td>
                    <td>
                      <a href="/admin/riwayat/anggota/delete/<?= $a['id'] ?>" class="btn btn-danger btn-sm btn-icon"
                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                        <i class="fa fa-trash"></i>
                      </a>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Modal Riwayat Anggota -->
<div class="modal fade" id="ranggota" tabindex="-1" aria-labelledby="ranggotaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ranggotaLabel">Tambah Riwayat Anggota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/admin/riwayat/anggota/save" method="post" id="orgform">
        <div class="modal-body">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control">
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="jabatan" class="form-label">Jabatan</label>
                <select name="jabatan" id="jabatan" class="custom-select">
                  <option></option>
                  <?php foreach ($fields as $f): ?>
                    <?php if (str_contains(strtolower($f['jabatan']), 'komisi')): ?>
                      <?php if (!preg_match('/[0-9]+/', $f['jabatan'])): ?>
                        <option value="<?= $f['jabatan'] ?>"><?= $f['jabatan'] ?></option>
                      <?php endif; ?>
                    <?php else: ?>
                      <option value="<?= $f['jabatan'] ?>"><?= $f['jabatan'] ?></option>
                    <?php endif; ?>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <div class="form-group">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="text" name="tahun" id="tahun" class="form-control">
              </div>
            </div>
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

<!-- Modal -->
<div class="modal fade" id="morg" tabindex="-1" aria-labelledby="morgLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="morgLabel">Edit Anggota Aktif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/admin/anggota/save" method="post" id="orgform">
        <div class="modal-body">
          <div class="row">
            <?php foreach ($fields as $field): ?>
              <div class="form-group <?= in_array($field['jabatan'], $colCondition) ? 'col-12 col-md-6' : 'col-12' ?>">
                <label for="nama" class="form-label mb-1">
                  <?php if (str_contains(strtolower($field['jabatan']), 'komisi')): ?>
                    Nama
                    <?= preg_replace('/[0-9]+/', '', $field['jabatan']) ?>
                  <?php else: ?>
                    Nama
                    <?= $field['jabatan'] ?>
                  <?php endif; ?>
                </label>
                <input type="text" name="<?= str_replace(" ", "_", $field['jabatan']) ?>" id="nama"
                  value="<?= $field['nama'] ?>" class="form-control">
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
  $(document).ready(function () {
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
      // .add(new go.Picture({
      //   width: 100,
      //   height: 100,
      //   source: "https://picsum.photos/200",
      // }))
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