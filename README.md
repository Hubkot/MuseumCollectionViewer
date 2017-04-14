Museum Collection Viewer :)
===

INSTALATION:
In config/AppKernel.php those lines should be deleted (if they exists):

    new AppBundle\AppBundle(),
    new Test\TestBundle(),
===

===
Entities

Artifact:
Main entity - holds the Unique Inventory Number (max 100 chars) and price (nullable)



A Symfony project created for GetNoticed2017
