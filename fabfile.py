# coding: utf-8

from fabric.api import env, run, cd

from skeleton import init, options, utils
from skeleton.git import git
from skeleton.httpd import vhost
from skeleton.wordpress import setup, wordpress, prepare, config, backup, replace

# RackSpace
env.user = 'root'
env.hosts = ['108.166.90.148']


def sync():
    utils.sync('/var/www/html/')


def rebuild():
    mysql = 'mysql -uroot -ppassword'

    with cd('/var/www/html/eventries.com'):
        run('%s -e "DROP DATABASE IF EXISTS eventries; CREATE DATABASE eventries;"' % mysql)
        run('%s --database eventries < sql/eventries.com-testing-latest.sql' % mysql)


def deploy():
    # get recent DB backup
    backup()
    # switch to testing server wp-config.php file
    config('testing', True)
    # upload files
    sync()
    # switch back to local wp-config.php file
    config()
    # update remote database
    rebuild()
