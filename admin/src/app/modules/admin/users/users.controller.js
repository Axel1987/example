import usersModalCtrl from './manage-user.controller';
import usersModalTemplate from './manage-user.modal.html';

usersCtrl.$inject = ['$scope', '$http', '$state', 'env', '$uibModal', '$password'];
export default function usersCtrl($scope, $http, $state, env, $uibModal, $password) {
    
    /** Default model of user */
    $scope.defaultUser = {
        name: '',
        email: '',
        phone: ''
    };
    
    /** Pagination default settings */
    $scope.maxSize = 10;
    $scope.totalItems = 1;
    $scope.lastPage = 1;
    $scope.currentPage = 1;

    /** Get list of users */
    $scope.getUsers = function () {
        $http.get(env.apiUrl + 'admin/users?page='+$scope.currentPage).then(
            function (response) {
                $scope.users = response.data.data;
                /** Setup pagination */
                $scope.currentPage = response.data.current_page;
                $scope.totalItems = response.data.total;
                $scope.maxSize = response.data.per_page;
                $scope.lastPage = response.data.last_page;
            }, function (error) {
                
            });
    };
    $scope.getUsers();

    $scope.pageChanged = function () {
        $scope.getUsers();
    };
    
    /** Edit User */    
    $scope.editUser = function (index) {
        var modalInstance = $uibModal.open({
            template: usersModalTemplate,
            controller: usersModalCtrl,
            resolve: {
                items: {
                    user: angular.copy($scope.users[index])
                }
            }
        });

        modalInstance.result.then(function (result) {
            $scope.users[index] = result;
        });
    };
    
    /** Create new user */
    $scope.addUser = function () {
        var modalInstance = $uibModal.open({
            template: usersModalTemplate,
            controller: usersModalCtrl,
            resolve: {
                items: {
                    user: angular.copy($scope.defaultUser)
                }
            }
        });

        modalInstance.result.then(function (result) {
            $scope.users.push(result);
        });
    };
    
    /** Change password to user */
    $scope.changePassword = function (user) {
        var password = $password.changePassword(user);
    }
}
