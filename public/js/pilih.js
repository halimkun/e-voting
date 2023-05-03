const btnView = document.querySelectorAll('.btnView');
const btnPilih = document.querySelectorAll('.btnPilih');
const radioOption = document.querySelectorAll('.pilihan');
const no_urut = document.getElementById('no_urut');
const misi = document.getElementById('misi');
const ketua = document.getElementById('ketua');
const wakil = document.getElementById('wakil');
const slogan = document.getElementById('slogan');
const visi = document.getElementById('visi');
const foto_kandidat = document.getElementById('foto_kandidat');
const srcImage = foto_kandidat.getAttribute('data-srcImage');

// ajax 
btnView.forEach(function(e){
  e.addEventListener("click", function(el){
    const href = e.getAttribute('data-href');
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function(){
      if (xhr.readyState == 4 && xhr.status == 200) {
        const data = JSON.parse(xhr.responseText);
        no_urut.innerHTML = data.no_urut;
        ketua.innerHTML = data.ketua;
        wakil.innerHTML = data.wakil;
        slogan.innerHTML = '"' + data.slogan + '"';
        visi.innerHTML = data.visi;
        misi.innerHTML = data.misi;
        foto_kandidat.src = srcImage + data.foto;
      }else{
       // alert("gagal load data!");
      }
    }
    
    xhr.open('GET', href , true);
    xhr.send();
  })
});

// logic pilihan
btnPilih.forEach(function(e, i){
  e.addEventListener('click', function(el){
    btnPilih.forEach(function(ele){
      ele.innerHTML = "pilih";
      ele.classList.remove('btnTerpilih');
    });
    radioOption.forEach(function(rd){
      rd.removeAttribute('checked');
    })
    e.innerHTML = "dipilih";
    e.classList.add('btnTerpilih');
    radioOption[i].setAttribute('checked', 'true');
  })
})