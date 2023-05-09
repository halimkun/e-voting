<?= $this->extend('layouts'); ?>
<?= $this->section('content'); ?>
<header class="masthead-75" style='background: linear-gradient(to bottom, rgba(4, 33, 76, 0.38) 0%, rgba(4, 33, 76, 0.75) 100%), url("https://smankesesi.sch.id/wp-content/uploads/2022/05/IMG_20220512_092459-scaled.jpg"); background-position: top; background-repeat: no-repeat; background-attachment: scroll; background-size: cover;'>
  <div class="container px-4 px-lg-5 h-100">
    <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
      <div class="col-lg-10 align-self-end">
        <h1 class="text-white font-weight-bold">ANGGOTA OSIS<br><?= setting('App.nama_sekolah') ?></h1>
      </div>
      <div class="col-lg-8 align-self-baseline">
        <p class="text-white mb-5">
          Dibawah ini adalah struktur organisasi dan kepengurusan <br> OSIS <?= setting('App.nama_sekolah') ?>.
        </p>
      </div>
    </div>
  </div>
</header>

<section class="page-section">
  <div class="container text-center">
    <h2 class="mt-0 mb-3">STRUKTUR ORGANISASI</h2>
    <div class="mb-4">
      <div id="myDiagramDiv" style="width:100% !important; height:350px !important;"></div>
    </div>
  </div>
</section>

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
        background: "#0d6efde6",
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