<?php
  setlocale(LC_TIME, 'fr_FR.utf8','fra');
?>
<!-- partial:partials/_horizontal-navbar.html -->
<nav class="navbar horizontal-layout col-lg-12 col-12 p-0">
    <div class="nav-top flex-grow-1">
      <div class="container d-flex flex-row h-100">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top">
          <a class="navbar-brand brand-logo" href="/"><img src=" {{ asset('assets/images/logo.png') }} "  alt="logo"/></a>
          <a class="navbar-brand brand-logo-mini" href="/"><img src=" {{ asset('assets/images/logo.png') }} " alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
          <!--<form class="search-field" action="#">
            <div class="form-group mb-0">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="search">
                <div class="input-group-append">
                  <span class="input-group-text"><i class="icon-magnifier"></i></span>
                </div>
              </div>
            </div>
          </form>-->
          <ul class="navbar-nav navbar-nav-right mr-0">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="icon-bell"></i>
                @if(nbreProduitsInferieurStock() > 0)
                <sup><span class="badge badge-pill badge-danger float-right"><small>{{ nbreProduitsInferieurStock() }}</small></span></sup>
                @endif
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <a class="dropdown-item py-3">
                  <p class="mb-0 font-weight-medium float-left">
                      Vous avez {{ nbreProduitsInferieurStock() }} Articles
                      <br>ayants atteint le seuil minimal
                      <br>En Stock
                  </p>
                  <span class="badge badge-pill badge-inverse-info float-right">View all</span>
                </a>
                <div class="dropdown-divider"></div>
                @foreach( getProduits() as $produit )
                  @if($produit->qteStock == $produit->qteMin)

                  <a class="dropdown-item preview-item" href="{{ route('produits.show', $produit->id) }}">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-inverse-danger">
                        <i class="icon-exclamation mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal text-dark mb-1">le produit  {{ $produit->designation }} </h6>
                      <p class="font-weight-light small-text mb-0">
                        a atteint le seuil minimal en stock
                      </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  @elseif( $produit->qteStock < $produit->qteMin)
                   <a class="dropdown-item preview-item"  href="{{ route('produits.show', $produit->id) }}">
                    <div class="preview-thumbnail">
                      <div class="preview-icon bg-inverse-danger">
                        <i class="icon-exclamation mx-0"></i>
                      </div>
                    </div>
                    <div class="preview-item-content">
                      <h6 class="preview-subject font-weight-normal text-dark mb-1">le produit  {{ $produit->designation }} </h6>
                      <p class="font-weight-light small-text mb-0">
                        a est inferieur au seuil minimal en stock
                      </p>
                    </div>
                  </a>
                  <div class="dropdown-divider"></div>
                  @endif
                @endforeach
                <!--<a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-inverse-warning">
                      <i class="icon-bubble mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal text-dark mb-1">Settings</h6>
                    <p class="font-weight-light small-text mb-0">
                      Private message
                    </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-inverse-info">
                      <i class="icon-user-following mx-0"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <h6 class="preview-subject font-weight-normal text-dark mb-1">New user registration</h6>
                    <p class="font-weight-light small-text mb-0">
                      2 days ago
                    </p>
                  </div>
                </a>-->
              </div>
            </li>
             <li class="nav-item nav-profile">
              <a class="nav-link" href="#">
                <span class="nav-profile-text">
                 <a href="#" class="text-white text-uppercase" style="text-decoration:none;">
                  {{ Auth::user()->name }}</a>
                </span>
                <!--<img src=" {{ asset('assets/images/faces/face1.jpg') }} " class="rounded-circle" alt="profile"/>-->
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
                <i class="icon-power"></i>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
              </form>
            </li>

          </ul>
          <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu text-white"></span>
          </button>
        </div>
      </div>
    </div>
    <div class="nav-bottom">
      <div class="container">
        <ul class="nav page-navigation">
          <li class="nav-item">
            <a href="/" class="nav-link"><i class="link-icon icon-screen-desktop"></i><span class="menu-title">Accueil</span></a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link"><i class="link-icon icon-book-open"></i><span class="menu-title">Consulter</span><i class="menu-arrow"></i></a>
            <div class="submenu">
              <ul class="submenu-item">

                <li class="nav-item"><a class="nav-link" href="/technicien">Liste des membres du Staff</a></li>
                <li class="nav-item"><a class="nav-link" href="/user">Liste des Utilisateurs</a></li>
                <li class="nav-item"><a class="nav-link" href="/famille">Liste des Familles</a></li>
                <li class="nav-item"><a class="nav-link" href="/produits">Liste des Articles</a></li>
                <li class="nav-item"><a class="nav-link" href="/fournisseur">Liste des Fournisseurs</a></li>
                <li class="nav-item"><a class="nav-link" href="/sorties">Liste des Bon de sorties d'Articles    </a></li>
                <li class="nav-item"><a class="nav-link" href="/retourStocks">Liste des Retour en Stocks d'Articles </a></li>

              </ul>
            </div>
          </li>

          @if(Auth::user()->role==0)
          <li class="nav-item">
            <a href="#" class="nav-link"><i class="link-icon icon-drawer"></i><span class="menu-title">Enregistrer</span><i class="menu-arrow"></i></a>
            <div class="submenu">
              <ul class="submenu-item">
                @if(( Auth::user()->role == 0  ) || Auth::user()->role == 1)
                  <li class="nav-item"><a class="nav-link" href="/technicien/create">Staff</a></li>
                  <li class="nav-item"><a class="nav-link" href="/user/create">Utilisateurs</a></li>
                @endif
                  <li class="nav-item"><a class="nav-link" href="/famille/create">Familles</a></li>
                  <li class="nav-item"><a class="nav-link" href="/produits/create">Produits</a></li>
                  <li class="nav-item"><a class="nav-link" href="/fournisseur/create">Fournisseur</a></li>
              </ul>
            </div>
          </li>
          @endif



          <li class="nav-item">
            <a href="{{ route('sortie.sortieProduit') }}" class="nav-link"><i class="link-icon icon-doc"></i><span class="menu-title">Faire un Bon de sortie </span></a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link"><i class="link-icon icon-doc"></i><span class="menu-title">Faire un Bon de Commande </span></a>
          </li>
          <li class="nav-item">
            <a href="/retourStocks/create" class="nav-link"><i class="link-icon icon-docs"></i><span class="menu-title">Enregistrer un Retour en Stock</span></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
