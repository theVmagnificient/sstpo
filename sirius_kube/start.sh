#!/bin/bash

minikube --vm-driver=none start \
  --extra-config=kubelet.resolv-conf=/run/systemd/resolve/resolv.conf
