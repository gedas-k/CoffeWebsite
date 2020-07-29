<?php
$title = "Home";
$content = '
<h3>…or create a new repository on the command line</h3>
<p>
…or create a new repository on the command line
echo "# front-page" >> README.md
git init
git add README.md
git commit -m "first commit"
git remote add origin https://github.com/gedas-k/front-page.git
git push -u origin master
                
…or push an existing repository from the command line
git remote add origin https://github.com/gedas-k/front-page.git
git push -u origin master
…or import code from another repository
You can initialize this repository with code from a Subversion, Mercurial, or TFS project.
</p>

<h3>…or push an existing repository from the command line</h3>
<p>
…or create a new repository on the command line
echo "# front-page" >> README.md
git init
git add README.md
git commit -m "first commit"
git remote add origin https://github.com/gedas-k/front-page.git
git push -u origin master
                
…or push an existing repository from the command line
git remote add origin https://github.com/gedas-k/front-page.git
git push -u origin master
…or import code from another repository
You can initialize this repository with code from a Subversion, Mercurial, or TFS project.
</p>

<h3>…or import code from another repository</h3>
<p>
…or create a new repository on the command line
echo "# front-page" >> README.md
git init
git add README.md
git commit -m "first commit"
git remote add origin https://github.com/gedas-k/front-page.git
git push -u origin master
                
…or push an existing repository from the command line
git remote add origin https://github.com/gedas-k/front-page.git
git push -u origin master
…or import code from another repository
You can initialize this repository with code from a Subversion, Mercurial, or TFS project.
</p>
';

include 'template.php';

?>
