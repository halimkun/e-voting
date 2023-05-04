      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <ul class="navbar-nav mr-3">
          <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
        <div class="form-inline mr-auto">
        </div>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <img alt="image" src="<?= base_url(); ?>/img/<?= getDataAdmin('foto_profile'); ?>" class="rounded-circle mr-1">
              <div class="d-sm-none d-md-inline-block">Hi, <?= getDataAdmin('nama'); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="<?= base_url(); ?>/admin/profile" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <a href="<?= base_url(); ?>/admin/setting" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Settings
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?= base_url(); ?>/logoutAdmin" class="dropdown-item has-icon text-danger" onclick="return confirm('Yakin ingin Logout??');">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="">
              SIEVOT
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="<?= ($act == 'dashboard') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?= base_url(); ?>/admin/dashboard">
                <i class="fas fa-fire"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="menu-header">Publikasi</li>
            <li class="<?= ($act == 'info') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?= base_url(); ?>/admin/info">
                <i class="fas fa-info-circle"></i>
                <span>Informasi</span>
              </a>
            </li>
            <li class="<?= ($act == 'agenda') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?= base_url(); ?>/admin/agenda">
                <i class="fas fa-calendar-alt"></i>
                <span>Agenda</span>
              </a>
            </li>
            <li class="<?= ($act == 'downloads') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?= base_url(); ?>/admin/files">
                <i class="fas fa-file"></i>
                <span>Downloads</span>
              </a>
            </li>
            <li class="menu-header">Data</li>
            <li class="<?= ($act == 'anggota') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?= base_url(); ?>/admin/anggota">
                <i class="fas fa-users"></i>
                <span>Anggota Aktif</span>
              </a>
            </li>
            <li class="<?= ($act == 'kandidat') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?= base_url(); ?>/admin/kandidat">
                <i class="fas fa-user-friends"></i>
                <span>Kandidat</span>
              </a>
            </li>
            <li class="<?= ($act == 'peserta') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?= base_url(); ?>/admin/peserta">
                <i class="fas fa-users"></i>
                <span>Peserta</span>
              </a>
            </li>
            <li class="<?= ($act == 'hasil_voting') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?= base_url(); ?>/admin/hasilVoting">
                <i class="fas fa-poll-h"></i>
                <span>Hasil Voting</span>
              </a>
            </li>
            <li class="menu-header">Laporan</li>
            <li class="nav-item dropdown <?= ($act == 'laporan') ? 'active' : ''; ?>">
              <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Laporan</span></a>
              <ul class="dropdown-menu">
                <li class="<?= (isset($act_list) && $act_list == 'laporan_kandidat') ? 'active' : '' ?>">
                  <a class="nav-link" href="<?= base_url(); ?>/admin/laporan/kandidat">
                    Data Kandidat
                  </a>
                </li>
                <li class="<?= (isset($act_list) && $act_list == 'laporan_peserta') ? 'active' : '' ?>">
                  <a class="nav-link" href="<?= base_url(); ?>/admin/laporan/peserta">
                    Data Peserta
                  </a>
                </li>
                <li class="<?= (isset($act_list) && $act_list == 'laporan_hasil') ? 'active' : '' ?>">
                  <a class="nav-link" href="<?= base_url(); ?>/admin/laporan/hasil">
                    Data Hasil
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-header">Setting</li>
            <li class="<?= ($act == 'profile') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?= base_url(); ?>/admin/profile">
                <i class="fas fa-user-edit"></i>
                <span>Edit profile</span>
              </a>
            </li>
            <li class="<?= ($act == 'setting') ? 'active' : ''; ?>">
              <a class="nav-link" href="<?= base_url(); ?>/admin/setting">
                <i class="fas fa-cogs"></i>
                <span>Setting</span>
              </a>
            </li>


          </ul>

        </aside>
      </div>