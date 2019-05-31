Pull Request Environments with Kubernetes
=========================================

To build quality applications you need a robust pull request workflow, one stage of this workflow is the "peer review".
Pull request environments allow you, the developer, to demonstrate your changes to the rest of the team during the peer
review stage.

But there are so many Pull Request environments!

What makes a great Pull Request environment? How do I integrate it into my existing pipeline?

PreviousNext have been building and running Pull Request infrastructure for the last 4 years. At the heart of our latest
iteration is M8s, our open source Pull Request builder running ontop of Kubernetes.

https://github.com/previousnext/m8s

With all the 3 major clouds adopting Kubernetes (as a service) M8s can run anywhere!

Come for the talk, leave with a new set of tools which you can use to improve your pipeline today!

## Who this talk is for

* Developers looking to spice up their review process
* Operators wanting improve their pull request environment infrastructure

## What will you get out of this talk

* The state of Pull Request environments
* An introduction to the core Kubernetes APIs
* Create your own pull request infastructure