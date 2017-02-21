var uname = getCookie('uname');
var urole = (getCookie('role')=="1" ? "管理员" : "教师");


var app = new Vue({
	el:'#app',
	data:{
		name:uname,
		role:urole,
		//保存左侧树形目录的状态和右侧内容的显示
		tree:{
			add:false,
			list:false,
			xd:false,
			xk:false,
			result:false,
			msg:false,
			exit:false
		},
		//保存教师列表的列
		columns:[
			{
				name:'id',
				colName:'id',
				isKey:true
			},
			{
				name:'uname',
				colName:'用户名'
			},
			{
				name:'phone',
				colName:'手机号'
			},
			{
				name:'age',
				colName:'年龄'
			},
			{
				name:'sex',
				colName:'性别',
				dataSource:['男','女']
			},
			{
				name:'danwei',
				colName:'单位'
			},
			{
				name:'xueli',
				colName:'学历',
				dataSource:['大专','本科','硕士','博士']
			},
			{
				name:'jiao_age',
				colName:'教龄'
			},
			{
				name:'email',
				colName:'邮箱'
			},
			{
				name:'sfz',
				colName:'身份证号'
			}
		],
		//保存从数据库中查询出的教师数据
		teacherData:[],
		apiUrl:'lib/php/a_teacher_list.php',
		item:{},
		mode:2
	},
	ready: function() {
			this.getTeacherData();
			this.setItem();
			this.setTree('list')
		},
	methods:{
		//从数据库中获取数据并保存在实例中
		getTeacherData:function(){
			var vm = this;
			vm.$http.get(vm.apiUrl)
				.then((response) => {
					vm.$set('teacherData', response.data);
				})
				.catch(function(response) {
                    console.log(response)
                })
		},
		//重置item中的值
		setItem:function(){
			for(var i=0;i<this.columns.length;i++){
				this.item[this.columns[i].name]=''
			}
		},
		//设置树形目录的样式
		setTree:function(str){
			for(var key in this.tree){
				this.tree[key] = (key === str) ? true : false;
			}
		}
	},
	events:{
		'init-form':function(){
			this.$broadcast('init-form-add')
		}
	},
	components:{
		//教师列表组件
		'admin-teacher-list':{
			template:'#teacherList',
			props:['tListColumns','teachers'],
			data:function(){
				return {
					//模糊查询，用户输入的查询关键字
					searchKey:'',
					delUrl:'lib/php/a_delete_teacher.php'
				}
			},
			methods:{
				deleteTeacher:function(index){
//					this.teachers.splice(index,1)
					/**
					 * 在数据库中删除数据
					 */
					var can = app.teacherData[index].uname;
//					console.log(can);
					app.$http.get(this.delUrl+"?name="+can)
				        .then((response) => {
				        	if(response.data == 'yes'){
				            	app.getTeacherData()
				            }
				        })
				},
				openTeacherAdd:function(num,index){
					app.mode=num;
					if(num==2){
						var teacher = this.teachers[index]
						for(var i=0;i<this.tListColumns.length;i++){
							var col = this.tListColumns[i].name
							sessionStorage.setItem(col,teacher[col]);
						}
					}
					app.setTree('add');
					this.$dispatch('init-form');
				}
			}
		},
		//教师添加组件
		'admin-teacher-add':{
			template:'#teacherAdd',
			props:['teacherColumns','item','mode'],
			data:function(){
				return {
					addUrl:'lib/php/a_teacher_add.php'
				}
			},
			ready:function(){
				
			},
			methods:{
				saveTeacher:function(){
					var key=$('#addForm').serialize();
					/**
					 * 将新增的数据保存在数据库中
					 */
					app.$http.get(this.addUrl+'?'+key)
						.then((response)=>{
//							console.log(response);
	                    	if(response.data == 'yes'){
				            	app.getTeacherData()
				            	app.setTree('list')
				            	this.clearForm()
				            }
				        })
				},
				//清空添加教师的表单
				clearForm:function(){
					$('#addForm :input').each(function(){
						$(this).val("")
					})
				}
			},
			events:{
				'init-form-add':function(){
					$('#addForm :input').each(function(i,dom){
						var curVal = sessionStorage.getItem($(dom).attr('name'));
						$(dom).val(curVal)
//						console.log($(dom).attr('name')+"="+curVal)
					})
				}
			}
		}
	}
})
