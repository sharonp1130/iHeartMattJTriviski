package help.me.orm.entity;

import javax.annotation.Generated;
import javax.persistence.metamodel.SingularAttribute;
import javax.persistence.metamodel.StaticMetamodel;

@Generated(value="Dali", date="2016-05-12T21:55:41.592-0700")
@StaticMetamodel(License.class)
public class License_ {
	public static volatile SingularAttribute<License, Integer> licenseId;
	public static volatile SingularAttribute<License, User> user;
	public static volatile SingularAttribute<License, String> licenseNumber;
	public static volatile SingularAttribute<License, Service> service;
	public static volatile SingularAttribute<License, Long> createdAt;
	public static volatile SingularAttribute<License, Long> updatedAt;
}
