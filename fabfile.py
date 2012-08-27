# coding: utf-8

from fabric.api import env

from skeleton import init, options, utils
from skeleton.git import git
from skeleton.httpd import vhost
from skeleton.mysql import replace, backup
from skeleton.wordpress import setup, wordpress, prepare, config

# RackSpace
env.user = 'root'
env.hosts = ['108.166.90.148']


def sync():
    utils.sync('/var/www/html/')
